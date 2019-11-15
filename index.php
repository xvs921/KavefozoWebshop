<form method="POST">
	<input type="hidden" name="action" value="cmd_insert_kavefozo_form">
	<input type="submit" value="Felvétel űrlap megjelenítése">
</form>	

<?php
if (isset($_POST["action"]) and $_POST["action"]=="cmd_insert_kavefozo_form"){
	$insert = new adatbazis();
	$insert->kapcsolodas();
	$insert->insert_kavefozo_form();
	$insert->kapcsolatbontas();	
}
if (isset($_POST["action"]) and $_POST["action"]=="cmd_insert_kavefozo"){
	$insert = new adatbazis();
	$insert->kapcsolodas();
	$insert->insert_kavefozo();
	$insert->kapcsolatbontas();	
}	
if(isset($_POST["action"]) and $_POST["action"]=="btn_delete"){
	$user_delete = new adatbazis();
	$user_delete->kapcsolodas();
	$user_delete->cmd_delete($_POST["input_id"] );
	$user_delete->kapcsolatbontas();
}
if (isset($_POST["action"]) and $_POST["action"]=="cmd_update_kavefozo_form"){
	$update_form = new adatbazis();
	$update_form->kapcsolodas();
	$update_form->update_form();
	$update_form->kapcsolatbontas();		
}
if (isset($_POST["action"]) and $_POST["action"]=="cmd_update_kavefozo"){
	$update_user = new adatbazis();
	$update_user->kapcsolodas();
	$update_user->cmd_update_kavefozo();
	$update_user->kapcsolatbontas();		
}
if (isset($_POST["action"]) and $_POST["action"]=="btnVanE"){
	$update_user = new adatbazis();
	$update_user->kapcsolodas();
	$update_user->cmd_update_daraloVanE();
	$update_user->kapcsolatbontas();		
}

$kavek = new adatbazis();
$kavek->kapcsolodas();
$kavek->select_kavefozok();
$kavek->kapcsolatbontas();

class adatbazis{
	public	$servername = "localhost:3307";
	public	$username = "root";
	public	$password = "";
	public	$dbname = "sajatbolt";
	public $conn = NULL;
	public $sql = NULL;
	public $result = NULL;
	public $row = NULL;
	
	public function kapcsolodas(){
		$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
		if ($this->conn->connect_error) {
			die("Connection failed: " . $this->conn->connect_error);
		}	
		$this->conn->query("SET NAMES 'UTF8';");
    }
    public function select_kavefozok(){
		$this->sql = "SELECT 
						`id`, 
						`nev`, 
						`ar`, 
						`gyartas_ideje`, 
						`daralo` 
				    FROM 
					    `kavefozok`";
		$this->result = $this->conn->query($this->sql);

		if ($this->result->num_rows > 0) {
			while($this->row = $this->result->fetch_assoc()) {
				echo "<p style=display:inline;>";
					echo $this->row["nev"] . " - ";
                    echo $this->row["ar"] . " - ";
                    echo $this->row["gyartas_ideje"] . " - ";
                    if($this->row["daralo"]==1)
                    {
                        echo "Van";
                    }
                    else{
                        echo "Nincs";
					}
					echo "<form method='POST' style=display:inline;>";
						echo "<input type='hidden' name='action' value='btn_delete'>";
						echo "<input type='hidden' name='input_id' value='".$this->row["id"]."'>";
						echo "<input type='submit' value='Törlés'>";
					echo "</form>";
					echo "<form method='POST' style=display:inline;>";
						echo "<input type='hidden' name='action' value='cmd_update_kavefozo_form'>";
						echo "<input type='hidden' name='input_id' value='".$this->row["id"]."'>";
						echo "<input type='submit' value='Módosítás'>";
					echo "</form>";
					echo "<form method='POST' style=display:inline;>";
					echo "<select name=input_daralo>";
						echo "<option value='1'>Van</option>";
						echo "<option value='0' selected>Nincs</option>";
					echo "</select>";
						echo "<input type='hidden' name='action' value='btnVanE'>";
						echo "<input type='hidden' name='input_id' value='".$this->row["id"]."'>";
						echo "<input type='submit' value='OK'>";
					echo "</form>";
				echo "</p>";
			}
		} else {
			echo "Nincs kávéfőző az adatbázisban.";
		}		
	}
    public function insert_kavefozo_form(){
		?>
		<h1>Felvétel űrlap</h1>
		<form method="POST">
			Add meg a termék nevét: <br />
			<input type="text" name="input_name"><br />
			Add meg az árat: <br />
			<input type="number" name="input_ar"><br />
			Add meg a gyártási időt: <br />
			<input type="date" name="input_gyartasiIdo"><br />		
			Van daráló funkció?: <br />	
			<select name="input_daralo">
				<option value='1'>Van</option>
				<option value='0' selected>Nincs</option>
			</select><br />	
			<input type="hidden" name="action" value="cmd_insert_kavefozo">
			<input type="submit" value="Felvétel">
		</form>			
		<?php
    }
    public function insert_kavefozo(){
		$this->sql = "INSERT INTO 
						kavefozok
							(
							`id`, 
							`nev`, 
							`ar`, 
							`gyartas_ideje`, 
							`daralo` 
							)
						VALUES
							(
							NULL,
							'".$_POST["input_name"]."',
							'".$_POST["input_ar"]."',
							'".$_POST["input_gyartasiIdo"]."',
							'".$_POST["input_daralo"]."'
							)
							";
		if($this->conn->query($this->sql)){
			echo "Sikeres adatfelvétel!<br />";
		} else {
			echo "Sikertelen adatfelvétel!<br />";
		}
	}
	public function cmd_delete($input_user_id){
		if($input_user_id=="") { return "<p>Sikertelen törlés, hiányzó azonosító!</p>"; }
		$this->sql = "DELETE FROM kavefozok
					  WHERE id	= $input_user_id";
		if($this->conn->query($this->sql)){
			return "<p>Sikeres törlés!</p>";
		} else {
			return "<p>Sikertelen törlés!</p>";
		}		
	}
	public function update_form(){
		$this->sql = "SELECT 
						`id`, 
						`nev`, 
						`ar`, 
						`gyartas_ideje`, 
						`daralo` 
					FROM 
						`kavefozok`
				WHERE
					`id` = ". $_POST["input_id"].";
					";
		$this->result = $this->conn->query($this->sql);

		if ($this->result->num_rows > 0) {
			while($this->row = $this->result->fetch_assoc()) {
					?>
					<h1>Módosítás űrlap</h1>
					<form method="POST">
						Add meg a termék nevét: <br />
						<input type="text" name="input_nev" value="<?php echo $this->row['nev'];?>"><br />
						Add meg az árat: <br />
						<input type="number" name="input_ar" value="<?php echo $this->row['ar'];?>"><br />
						Add meg a gyártási időt: <br />
						<input type="date" name="input_gyartasiIdo" value="<?php echo $this->row['gyartas_ideje'];?>"><br />		
						Van daráló funkció?: <br />	
						<select name="input_daralo" value="<?php echo $this->row['daralo'];?>">
							<option value='1'>Van</option>
							<option value='0' selected>Nincs</option>
						</select><br />	
						<input type="hidden" name="input_id" 
							value="<?php echo  $this->row["id"]; ?>">
						<input type="hidden" name="action" value="cmd_update_kavefozo">
						<input type="submit" value="Módosítás">
					</form>														
					<?php
			}
		}
	}

		public function cmd_update_kavefozo(){
			$this->sql = "UPDATE 
							kavefozok
						  SET
							`nev`='".$_POST["input_nev"]."',
							`ar`='".$_POST["input_ar"]."',
							`gyartas_ideje`='".$_POST["input_gyartasiIdo"]."',
							`daralo`='".$_POST["input_daralo"]."' 
						  WHERE
							 `id` = ". $_POST["input_id"]."
								;";
			if($this->conn->query($this->sql)){
				echo "Sikeres adatmódosítás!<br />";
			} else {
				echo "Sikertelen adatmódosítás!<br />";
			}		
		}	
		public function cmd_update_daraloVanE(){
			$this->sql = "UPDATE 
							kavefozok
						  SET
							`daralo`='".$_POST["input_daralo"]."' 
						  WHERE
							 `id` = ". $_POST["input_id"]."
								;";
			if($this->conn->query($this->sql)){
				echo "Sikeres adatmódosítás!<br />";
			} else {
				echo "Sikertelen adatmódosítás!<br />";
			}		
		}			

    
    public function kapcsolatbontas(){
		$this->conn->close();		
    }
}
?>