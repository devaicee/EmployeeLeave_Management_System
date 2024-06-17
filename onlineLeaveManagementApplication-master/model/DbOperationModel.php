<?php
include("ConnectionModel.php");

class DbOperation
{
    public function dbSelect($columnsName, $tablesName, $conditions)
    {
        $objConnection = new Connection();
        $objConnection->dbConnection();
        $con = $objConnection->con;
        
        $sql = "SELECT DISTINCT $columnsName FROM $tablesName WHERE $conditions";
        $result = mysqli_query($con, $sql);
        
        $objConnection->dbCloseConnection();
        return $result;
    }

    public function dbJoinSelect($columnsName, $tablesName, $conditions)
    {
        $objConnection = new Connection();
        $objConnection->dbConnection();
        $con = $objConnection->con;
        
        $sql = "SELECT $columnsName FROM $tablesName ON $conditions";
        $result = mysqli_query($con, $sql);
        
        $objConnection->dbCloseConnection();
        return $result;
    }

    public function dbInsert($columnsName, $tablesName, $values)
    {
        $objConnection = new Connection();
        $objConnection->dbConnection();
        $con = $objConnection->con;
        
        $sql = "INSERT INTO $tablesName($columnsName) VALUES ($values)";
        $result = mysqli_query($con, $sql);
        
        $objConnection->dbCloseConnection();
        return $result;
    }

    public function dbEmpSelect($columnsName, $tablesName, $conditions)
    {
        $objConnection = new Connection();
        $objConnection->dbConnection();
        $con = $objConnection->con;
        
        $sql = "SELECT DISTINCT $columnsName FROM $tablesName $conditions";
        $result = mysqli_query($con, $sql);
        
        $objConnection->dbCloseConnection();
        return $result;
    }

    public function dbJoinSingleSelect($columnsName, $tablesName, $conditions)
    {
        $objConnection = new Connection();
        $objConnection->dbConnection();
        $con = $objConnection->con;
        
        $sql = "SELECT $columnsName FROM $tablesName $conditions";
        $result = mysqli_query($con, $sql);
        
        $objConnection->dbCloseConnection();
        return $result;
    }

    public function dbSelectAll($columnsName, $tablesName, $conditions)
    {
        $objConnection = new Connection();
        $objConnection->dbConnection();
        $con = $objConnection->con;
        
        $sql = "SELECT $columnsName FROM $tablesName WHERE $conditions";
        $result = mysqli_query($con, $sql);
        
        $objConnection->dbCloseConnection();
        return $result;
    }

    public function dbUpdate($columnsName, $tablesName, $conditions)
    {
        $objConnection = new Connection();
        $objConnection->dbConnection();
        $con = $objConnection->con;
        
        $sql = "UPDATE $tablesName SET $columnsName WHERE $conditions";
        $result = mysqli_query($con, $sql);
        
        var_dump($sql);
        $objConnection->dbCloseConnection();
        return $result;
    }

    public function dbDelete($tablesName, $conditions)
    {
        $objConnection = new Connection();
        $objConnection->dbConnection();
        $con = $objConnection->con;
        
        $sql = "DELETE FROM $tablesName WHERE $conditions";
        $result = mysqli_query($con, $sql);
        
        var_dump($sql);
        $objConnection->dbCloseConnection();
        return $result;
    }

    public function getForRecomandationNumber()
    {
        $columnsName = "COUNT(lIsRecomanded)";
        $tablesName = "employeeleaveapplicationdetails";
        $conditions = "lIsRecomanded = 0";
        $result = $this->dbSelectAll($columnsName, $tablesName, $conditions);
        return $result;
    }

    public function getRecomandationNumber()
    {
        $columnsName = "COUNT(lIsRecomanded)";
        $tablesName = "employeeleaveapplicationdetails";
        $conditions = "lIsRecomanded = 1 AND lIsApproved = 0";
        $result = $this->dbSelectAll($columnsName, $tablesName, $conditions);
        return $result;
    }

    public function forLeaveDaysRemain($livLeaveId)
    {
        $columnsName = "lTotalLeaveDaysRemain";
        $tablesName = "employeeleaveapplicationdetails";
        $conditions = "WHERE lEmployeeCodeNumberWhoApply = '".$_SESSION['officeUserName']."' AND lLeaveId = $livLeaveId AND lIsApproved = 1 ORDER BY lId DESC LIMIT 1";
        $result = $this->dbJoinSingleSelect($columnsName, $tablesName, $conditions);
        return $result;
    }

    public function forLeaveDays($livLeaveId)
    {
        $columnsName = "lTotalDays";
        $tablesName = "leavedetails";
        $conditions = "WHERE lId = $livLeaveId";
        $result = $this->dbJoinSingleSelect($columnsName, $tablesName, $conditions);
        return $result;
    }

    public function leaveDaysRemainForOneUser($applicantUserCodeNumber, $livLeaveId)
    {
        $columnsName = "lTotalLeaveDaysRemain";
        $tablesName = "employeeleaveapplicationdetails";
        $conditions = "WHERE lEmployeeCodeNumberWhoApply = '$applicantUserCodeNumber' AND lLeaveId = $livLeaveId AND lIsApproved = 1 ORDER BY lId DESC LIMIT 1";
        $result = $this->dbJoinSingleSelect($columnsName, $tablesName, $conditions);
        return $result;
    }

    public function forLeaveDaysRemainWhenUpdate($livLeaveId)
    {
        $columnsName = "lTotalLeaveDaysRemain";
        $tablesName = "employeeleaveapplicationdetails";
        $conditions = "WHERE lId = $livLeaveId AND lLeaveId = $livLeaveId AND lIsApproved = 1 ORDER BY lId DESC LIMIT 1";
        $result = $this->dbJoinSingleSelect($columnsName, $tablesName, $conditions);
        return $result;
    }

    public function forNewLeaveDaysRemain($livUserCode, $livUserLeaveType)
    {
        $columnsName = "lTotalLeaveDaysRemain";
        $tablesName = "employeeleaveapplicationdetails";
        $conditions = "WHERE lEmployeeCodeNumberWhoApply = '$livUserCode' AND lLeaveId = $livUserLeaveType AND lIsApproved = 1 ORDER BY lId DESC LIMIT 1";
        $result = $this->dbJoinSingleSelect($columnsName, $tablesName, $conditions);
        return $result;
    }
}
?>
