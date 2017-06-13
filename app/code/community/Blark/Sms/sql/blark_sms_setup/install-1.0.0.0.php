<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$installer = $this;

$installer->startSetup();

$table= $installer->getConnection()
        ->newTable($installer->getTable('blark_sms/sms'))
        ->addColumn('id',Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
                    'identity' => true,
                    'unsigned' => true,
                    'nullable' => false,
                    'primary'  => true,
                ))
        
        ->addColumn('group_name',Varien_Db_ddl_Table::TYPE_VARCHAR,300, array(
                    'nullable' => false            
                ))
        
        ->addColumn('phone_numbers',Varien_Db_ddl_Table::TYPE_TEXT, null, array(
                    'nullable' => false            
                ))
        
        ->addColumn('comments',Varien_Db_ddl_Table::TYPE_VARCHAR,300, array(
                    'nullable' => true            
                ))
        
        ->addColumn('number_count',Varien_Db_ddl_Table::TYPE_INTEGER,11, array(
                    'nullable' => false            
                ))
        
        ->addColumn('last_sent',Varien_Db_ddl_Table::TYPE_DATETIME,null, array(
                    'nullable' => true            
                ),'last_seen')
        
        ->addColumn('created_at',Varien_Db_ddl_Table::TYPE_DATETIME,null, array(
                    'nullable' => false            
                ),'created_at')
        
       ->addColumn('updated_at',Varien_Db_ddl_Table::TYPE_DATETIME,null, array(
                    'nullable' => false        
                ),'updated_at');

        $installer->getConnection()->createTable($table);
        
        $installer->endSetup();