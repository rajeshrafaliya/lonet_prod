<?php
function xmldb_local_lonet_upgrade($oldversion) {
    global $CFG, $DB, $OUTPUT;

    $dbman = $DB->get_manager(); // loads ddl manager and xmldb classes

    if ($oldversion < 2019102502) {

        // Define field isgrouplesson to be added to tool_brickfield_checks.
        $table = new xmldb_table('lonet_order_book');
        $field = new xmldb_field('isgrouplesson', XMLDB_TYPE_INTEGER, '1', null, null, null, '0', 'iscompleted');

        // Conditionally launch add field isgrouplesson.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Brickfield savepoint reached.
        upgrade_plugin_savepoint(true, 2019102502, 'local', 'lonet');
    }
    if ($oldversion < 2019102503) {

        // Define field isgrouplesson to be added to tool_brickfield_checks.
        $table = new xmldb_table('lonet_order_product');
        $field = new xmldb_field('isgrouplesson', XMLDB_TYPE_INTEGER, '1', null, null, null, '0', 'comment');

        // Conditionally launch add field isgrouplesson.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Brickfield savepoint reached.
        upgrade_plugin_savepoint(true, 2019102503, 'local', 'lonet');
    }
    return true;
}
