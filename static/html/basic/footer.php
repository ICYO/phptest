<!--
<div id="footer">
	<div class="tst">start at 2016-9-24</div>
</div>
-->
    </body>

	<script src="/js/basic/basic.js"></script>
<?php if(isset($data['js'])) { foreach($data['js'] as $js) { ?>
		 <script src="<?php echo $js; ?>"></script>
<?php }} ?>
</html>
