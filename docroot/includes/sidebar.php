<?php

include(__DIR__ . "/../config.php");

$q = $MARKLOGIC . "/admin/gimme.xqy";
$x = fopen($q, 'rb');
$xmlstring = stream_get_contents($x);
fclose($x);

$xml = new DOMDocument();
$xml->loadXML($xmlstring);

$xsl = new DOMDocument();
$xsl->load('xslt/alleadidssidebar.xsl');

$xp = new XSLTProcessor();
$xp->importStyleSheet($xsl);

$ALLFINDINGAIDS = $xp->transformToXML($xml);

?>

<div class="bgse">
<div class="bgsw">
<div class="bgne"><h2 class="bgnw">Search all Finding Aids</h2>
  </div>
<form action="search.php" id="searchform" method="get">
<input id="searchterm" name="q" type="text"/>
<p style="font-size: 13px;">
  <input name="exactphrase" style="display: inline; width: auto;" type="checkbox" /> search this exact phrase</p>
<input type="submit" value="Search"/>
<p><a href="advancedsearch.html" id="advancedsearchlink">Advanced Search</a></p>
</form>
</div>
</div>

<div class="bgse">
<div class="bgsw">
<div class="bgne">
  <h2 class="bgnw">Browse by Organization</h2>
</div>

<ul>
<?php foreach (array('Bronzeville Historical', 'CBMR', 'Chicago History Museum','Columbia College',
                     'Cook County', 'Chicago State', 'Chicago Youth Ctr', 'Defender', 'Depaul',
                     'Dominican', 'Dusable', 'Evanston History Ctr', 'ETA Creative Arts', 'Gerber Hart', 'CPL-Harsh',
                     'CPL-HWLC', 'Illinois Tech', 'IL Labor History', 'Intl Society Slave Ancestry', 'Kartemquin', 'Lake Cty Discovery',
                     'Lane Tech HS', 'Little Black Pearl', 'Loyola', 'Malcolm X College', 'Northeastern IL',
                     'Newberry', 'North Park', 'Northwestern', 'Pullman Historic Site', 'Roosevelt',
                     'Rush U Med Ctr', 'Shorefront', 'Spertus', 'South Side Community Arts Ctr',
                     'UIC', 'UChicago') as $collection)
                     { ?>
    <li><a href="/browse.php?browse=<?=$collection?>"><?=$collection?></a></li>
<?php } ?>
</ul>
<div class="bgse">
<div class="bgsw">
<div class="bgne">
  <h2 class="bgnw">Browse All Finding Aids</h2></div>

<ul>
<li><a href="/browse.php">more ...</a></li>
</ul>
</div>
</div>
</ul>
</div>
</div>
