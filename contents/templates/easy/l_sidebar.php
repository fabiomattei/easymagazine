<!-- begin l_sidebar -->

	<div id="l_sidebar">
	<ul id="l_sidebarwidgeted">

	<li id="Numbers">
	<h2>Last Numbers</h2>
	<ul>
        <? foreach ($this->numbers as $num) {
           echo '<li><a href="'.URIMaker::number($num).'">'.$num->getTitle().'</a></li>';
       }?>
        </ul>

	<li id="Admin">
	<h2>Admin</h2>
		<ul>
		hello admin register
		<li>login logout</li>
		<li><a href="http://www.wordpress.org/">hello</a></li>
		<li><a href="http://validator.w3.org/check?uri=referer">hello</a></li>
		</ul>
			
</div>

<!-- end l_sidebar -->