<?php

class rex_list_extended extends rex_list {

    function setStatusColumn($columnName, $tableName, $status = null, $links = true) {
        if ($status == null) {
            $status[0] = array('name' => 'Offline', 'class' => 'rex-offline');
            $status[1] = array('name' => 'Online', 'class' => 'rex-online');
        }
        if ($links)
            $this->setColumnParams($columnName, array('func' => 'setstatus', 'table' => $tableName, 'statusfield' => $columnName, 'oldstatus' => '###' . $columnName . '###', 'minstatus' => (min(array_keys($status))), 'maxstatus' => (max(array_keys($status))), 'oid' => '###id###'));
        $this->setColumnLayout($columnName, array('<th>' . $this->getColumnLabel($columnName) . '</th>', '<td style="text-align:center;">###VALUE###</td>'));
        $this->setColumnFormat($columnName, 'status', $status);
    }

    function setAmountColumn($columnName, $tableName, $status = null, $links = true) {
        if ($status == null) {
            $status[0] = array('name' => 'Offline', 'class' => 'rex-offline');
            $status[1] = array('name' => 'Online', 'class' => 'rex-online');
            $status[2] = array('name' => 'Online', 'class' => 'rex-online');
            $status[3] = array('name' => 'Online', 'class' => 'rex-online');
        }
        if ($links) {
            $this->setColumnParams($columnName, array(
                'func' => 'setstatus',
                'table' => $tableName,
                'statusfield' => $columnName,
                'oldstatus' => '###' . $columnName . '###',
                'minstatus' => (min(array_keys($status)) + 1),
                'maxstatus' => (max(array_keys($status))),
                'oid' => '###id###'
            ));
        }
        $this->setColumnLayout($columnName, array('<th>' . $this->getColumnLabel($columnName) . '</th>', '<td style="text-align:center;">###VALUE###</td>'));
        $this->setColumnFormat($columnName, 'status', $status);
    }

    function setDateColumnALT($columnName, $dateformat = '%d.%m.%y') {
        $this->setColumnFormat($columnName, 'strftime', $dateformat);
    }

    function setDateColumn($columnName) {
        $this->setColumnFormat($columnName, 'custom', 
            create_function(
                '$params', '$list = $params["list"];
                return formatNewDate($list->getValue(' . $columnName . '));'
            )
        );
    }

    function addDeleteColumn($head = '&nbsp;', $body = null, $table) {
        global $I18N;
        if ($body === null)
            $body = $I18N->msg('delete');
        $this->addColumn('delete', $body, -1, array("<th style=\"width:60px;\">$head</th>", '<td style="text-align:center;">###VALUE###</td>'));
        $this->setColumnParams('delete', array('func' => 'delete', 'table' => $table, 'oid' => '###id###'));
        $this->addLinkAttribute('delete', 'onclick', "return confirm('" . $I18N->msg('a350_really_delete') . "');");
    }

    function prepareQuery($query) {
        global $_orderby;
        $rowsPerPage = $this->getRowsPerPage();
        $startRow = $this->getStartRow();

        if (rex_request('sort') && ($_orderby != ""))
            $sortColumn = $_orderby;
        else
            $sortColumn = $this->getSortColumn();
        if ($sortColumn != '') {
            $sortType = $this->getSortType();

            if (strpos(strtoupper($query), 'ORDER BY') === false)
                $query .= ' ORDER BY ' . $sortColumn . ' ' . $sortType;
            else {
                if (rex_request('sorttype') == 'desc')
                    $query = $query . $sortType;
                else
                    $query = preg_replace('/ORDER BY [^ ]*(asc|desc)?/i', 'ORDER BY ' . $sortColumn . ' ' . $sortType, $query);
            }
        }
        $query .= ' LIMIT ' . $startRow . ',' . $rowsPerPage;

        return $query;
    }

}