<?php
$int = $ROUTER_ARGS[0];
$string = $ROUTER_ARGS[1];
?>

<h1>rest/:int/:string</h1>
<p>You are here because you requested the path <code><?php echo $int;?>/<?php echo $string;?></code>.</p>
<p>That is expected for the router pattern <code>:/int/:string</code>.</p>
<p>Try change the <code>int</code> or <code>string</code> to something different, or try pass a not <code>int</code> as first param.</p>
