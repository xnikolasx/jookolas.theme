<?php
function modChrome_jookolas($module, &$params, &$attribs) {
    if(!empty($module->content)) {
        if($module->showtitle) {
            echo "<h4>" . $module->title . "</h4>";
        }                       
        echo $module->content;
    }
}
?>