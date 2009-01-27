<?

/*
    Copyright (C) 2009  Fabio Mattei

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

class Query {

    private static $instance = null;

    private function __construct()
    {
        // ... codice ...
    }

    public static function getInstance()
    {
        if(self::$instance == null)
        {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }

    function vuota() {
    }

    function InsertDbRow($table, $arraydata, $pretab, $connection) {
        $resulta = mysql_query('select max(id) from '.$pretab.$table, $connection);
        if (!$resulta) {
            erroreconnection(1,'funadmin.php','select max(id) from '.$pretab.$table.' '.mysql_error(), $connection);
            $id=-1;
        }
        while ($row = mysql_fetch_row($resulta)){
            $id=$row[0]+1;
        }
        $campi='id,';
        $valori=$id.',';
        foreach ($arraydata as $campo => $valore) {
            $campi.=' '.$campo.',';
            $valore=str_replace("'", "\'", $valore);
            if ($valore=='NOW()') $valori.=" NOW(),"; // Serve per permettere di inserire NOW nelle query dentro le apicelle
            else $valori.=" '$valore',";
        }
        $campi=substr($campi,0,strlen($campi)-1);  // sego la virgola finale
        $valori=substr($valori,0,strlen($valori)-1);
        $result = mysql_query('INSERT INTO '.$pretab.$table.' ('.$campi.') VALUES ('.$valori.')', $connection);
        if (!$result) {
            erroreconnection(1,'funadmin.php','SQL: '.'INSERT INTO '.$pretab.$table.' ('.$campi.') VALUES ('.$valori.')'.mysql_error(), $connection);
            $id=-1;
        }
        return $id;
    }

    function UpdateDbRow($id, $table, $arraydata, $pretab, $connection) {
        $campi='';
        $valori='';
        foreach ($arraydata as $campo => $valore) {
            $valore=str_replace("'", "\'", $valore);
            if ($campo=='NOW()') $campi.=' '.$campo.'=NOW(),';
            else $campi.=' '.$campo.'=\''.$valore.'\',';
        }
        $campi=substr($campi,0,strlen($campi)-1);  // sego la virgola finale
        $result=mysql_query('UPDATE '.$pretab.$table.' SET '.$campi.' WHERE id=\''.$id.'\'', $connection);
        if (!$result) {
            erroreconnection(1,'funadmin.php','SQL: '.'UPDATE '.$pretab.$table.' SET '.$campi.' WHERE id=\''.$id.'\''.mysql_error(), $connection);
            $id=-1;
        }
        return $id;
    }

    function UpdateDbRowWithConditions($conditions, $table, $arraydata, $pretab, $connection) {
        $campi='';
        $valori='';
        foreach ($arraydata as $campo => $valore) {
            $valore=str_replace("'", "\'", $valore);
            $campi.=' '.$campo.'=\''.$valore.'\',';
        }
        $campi=substr($campi,0,strlen($campi)-1);  // sego la virgola finale
        $result=mysql_query('UPDATE '.$pretab.$table.' SET '.$campi.' WHERE '.$conditions, $connection);
        if (!$result) {
            erroreconnection(1,'funadmin.php','SQL: '.'UPDATE '.$pretab.$table.' SET '.$campi.' WHERE id=\''.$id.'\''.mysql_error(), $connection);
            $id=-1;
        }
        return $id;
    }

    function DeleteDbRow($id, $table, $pretab, $connection) {
        $result=mysql_query('DELETE FROM '.$pretab.$table.' WHERE id=\''.$id.'\'', $connection);
        if (!$result) {
            erroreconnection(1,'funadmin.php','SQL: '.'DELETE FROM '.$pretab.$table.' WHERE id=\''.$id.'\''.mysql_error(), $connection);
            $id=-1;
        }
        return $id;
    }

    function DeleteRowsConditions($table, $pretab, $connection, $conditions) {
        $result=mysql_query('DELETE FROM '.$pretab.$table.' WHERE '.$conditions, $connection);
        if (!$result) {
            erroreconnection(1,'funadmin.php','SQL: '.'DELETE FROM '.$pretab.$table.' WHERE '.$conditions.mysql_error(), $connection);
            $id=-1;
        }
        return $id;
    }

    function SelectDbArray($id, $table, $pretab, $connection) {
        $query='SELECT * FROM '.$pretab.$table.' WHERE id=\''.$id.'\'';
        $result=mysql_query($query, $connection);
        $row = mysql_fetch_array($result);
        if (!$result) erroreconnection(1,'funadmin.php','SQL: '.$query.' '.mysql_error(), $connection);
        return $row;
    }

    function SelectDbArrayWithCondition($table, $condition,$pretab, $connection) {
        $query='SELECT * FROM '.$pretab.$table.' WHERE '.$condition;
        $result=mysql_query($query, $connection);
        $row = mysql_fetch_array($result);
        if (!$result) erroreconnection(1,'funadmin.php','SQL: '.$query.' '.mysql_error(), $connection);
        return $row;
    }

    function SelectDependingDbArray($iddep, $table, $columndep, $pretab, $connection) {
        $query='SELECT * FROM '.$pretab.$table.' WHERE '.$columndep.'=\''.$iddep.'\'';
        $result=mysql_query($query, $connection);
        $row = mysql_fetch_array($result);
        if (!$result) erroreconnection(1,'funadmin.php','SQL: '.$query.' '.mysql_error(), $connection);
        return $row;
    }

    function SelectDependingTable($iddep, $table, $columndep, $pretab, $connection) {
        $query='SELECT * FROM '.$pretab.$table.' WHERE '.$columndep.'=\''.$iddep.'\'';
        $result=mysql_query($query, $connection);
        if (!$result) erroreconnection(1,'funadmin.php','SQL: '.$query.' '.mysql_error(), $connection);
        return $result;
    }

    function SelectDependingTableOrder($iddep, $table, $columndep, $order, $pretab, $connection) {
        $query='SELECT * FROM '.$pretab.$table.' WHERE '.$columndep.'=\''.$iddep.'\' ORDER BY \''.$order.'\'';
        $result=mysql_query($query, $connection);
        if (!$result) erroreconnection(1,'funadmin.php','SQL: '.$query.' '.mysql_error(), $connection);
        return $result;
    }

    function SelectDbRows($table, $arraydata, $pretab, $connection, $ordine="id", $direzione="") {
        $campi='';
        foreach ($arraydata as $campo => $etichetta) {
            $campi.=' '.$campo.',';
        }
        $campi=substr($campi,0,strlen($campi)-1);
        $query='SELECT '.$campi.' FROM '.$pretab.$table.' ORDER BY '.$ordine.' '.$direzione;
        $result=mysql_query($query, $connection);
        if (!$result) erroreconnection(1,'funadmin.php','SQL: '.$query.' '.mysql_error(), $connection);
        return $result;
    }

    function SelectDbRowsWithLimit($table, $arraydata, $pretab, $connection, $ordine="id", $direzione="", $perpagina="0, 20", $condizione) {
        $campi='';
        foreach ($arraydata as $campo => $etichetta) {
            $campi.=' '.$campo.',';
        }

        if ($condizione!="NULL" && $condizione!="") $condizione=" WHERE ".$condizione;
        else						$condizione="";

        $campi=substr($campi,0,strlen($campi)-1);
        $query='SELECT '.$campi.' FROM '.$pretab.$table.' '.$condizione.' ORDER BY '.$ordine.' '.$direzione.' LIMIT '.$perpagina;
        $result=mysql_query($query, $connection);
        if (!$result) erroreconnection(1,'funadmin.php','SQL: '.$query.' '.mysql_error(), $connection);
        return $result;
    }

    function SelectDbRowsWithLimitJoinigTables($table, $arraydata, $pretab, $connection, $ordine="id", $direzione="", $perpagina="0, 20", $condizione) {
        $campi='';
        $tabelle=array();
        foreach ($arraydata as $campo => $etichetta) {
            if (substr($campo, 0, 3)=="id_") {
                $campi.=' '.substr($campo, 3).'.'.substr($campo, 3).',';
                $tabelle[] = substr($campo, 3);
            }
            else {
                $campi.='  '.$table.'.'.$campo.',';
            }
        }

        if ($condizione!="NULL" && $condizione!="") $condizione=" WHERE ".$condizione;
        else	$condizione=" WHERE 1=1 ";

        $tabquery=$pretab.$table.' as '.$table.' ';
        foreach ($tabelle as $tab) {
            $tabquery.=', '.$pretab.$tab.' as '.$tab.' ';
        }

        $predicatiJoin='';
        foreach ($tabelle as $tab) {
            $predicatiJoin.=' AND '.$table.'.id_'.$tab.' = '.$tab.'.id ';
        }

        if ($perpagina=="No Limit") {
            $accodaperpagina='';
        } else {
            $accodaperpagina=' LIMIT '.$perpagina;
        }

        $campi=substr($campi,0,strlen($campi)-1);
        $query='SELECT '.$campi.' FROM '.$tabquery.' '.$condizione.' '.$predicatiJoin.' ORDER BY '.$table.'.'.$ordine.' '.$direzione.$accodaperpagina;
        $result=mysql_query($query, $connection);
        if (!$result) erroreconnection(1,'funadmin.php','SQL: '.$query.' '.mysql_error(), $connection);
        return $result;
    }

    function SelectGeneric($sql , $pretab, $connection){
        $result=mysql_query($sql, $connection);
        return $result;
    }

    function GenericSelect($table, $arraydata, $pretab, $connection, $condizioni="", $ordine="", $direzione="", $perpagina="") {
        $campi='';
        foreach ($arraydata as $campo => $etichetta) {
            $campi.=' '.$campo.',';
        }
        $campi=substr($campi,0,strlen($campi)-1);
        if ($condizioni) $condizioni='WHERE '.$condizioni;
        if ($ordine) $ordine=' ORDER BY '.$ordine.' '.$direzione;
        if ($ordine) $perpagina=' LIMIT '.$perpagina;
        $query='SELECT '.$campi.' FROM '.$pretab.$table.' '.$condizioni.' '.$ordine.' '.$perpagina;
        $result=mysql_query($query, $connection);
        if (!$result) erroreconnection(1,'funadmin.php','SQL: '.$query.' '.mysql_error(), $connection);
        return $result;
    }

}
?>