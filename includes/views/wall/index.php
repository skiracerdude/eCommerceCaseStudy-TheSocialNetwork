<div>
	<h1 align="center"><?php echo $this->name ?>'s Wall</h1>
</div>

<div>
	<style scoped type="text/css">
	.tg  {border-collapse:collapse;border-spacing:0;border-color:#aabcfe;border:none;}
	.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#669;background-color:#e8edff;}
	.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#039;background-color:#b9c9fe;}
	.tg .tg-smzr{font-family:"Times New Roman", Times, serif !important;;vertical-align:top}
	</style>
	<table class="tg" align="left">
	  <tr>
		<th class="tg-smzr">See other ppl</th>
	  </tr>
	  <tr><td>FRIENDS </td></tr> <tr><td>should </td></tr> <tr><td>be</td> </tr><tr><td>listed </td></tr> <tr><td>	here </td></tr>
	</table>

	<style type="text/css"  scoped>
	.ff  {border-collapse:collapse;border-spacing:0;border-color:#aabcfe;border:none;}
	.ff td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#669;background-color:#e8edff;text-align:right}
	.ff th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#039;background-color:#b9c9fe;}
	.ff .ff-smzr{font-family:"Times New Roman", Times, serif !important;;vertical-align:top}
	</style>
	<table class="ff" align="right">
	  <tr>
		<th class="ff-smzr">Other possible friends list</th>
	  </tr>
	  <tr><td>Friends</td></tr> <tr><td>should </td></tr> <tr><td>be</td> </tr><tr><td>listed </td></tr> <tr><td>	here </td></tr>
	</table>

	<style type="text/css" scoped>
	.gg  {border-collapse:collapse;border-spacing:0;border-color:#aabcfe;margin:0 auto;}
	.gg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#669;background-color:#e8edff;}
	.gg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#039;background-color:#b9c9fe;}
	.gg .gg-7un6{background-color:#ffffff;color:#000000;text-align:center;vertical-align:top}
	.gg .gg-kixb{background-color:#ffffff;color:#000000;vertical-align:top}
	.gg .gg-pxng{background-color:#ffffff;color:#000000;vertical-align:top}
	</style>
	<table class="gg" style="undefined;table-layout: fixed; width: 60%">
	<colgroup>
	<col style="width:80%">
	<col style="width:20%">
	</colgroup>
	  <tr>
		<th class="gg-7un6" colspan="2">Posts</th>
	  </tr>
		<?php
            if (isset($this->posts) AND count($this->posts) > 0 ) {
                foreach($this->posts as $this->post) {
                    include PATH . 'views/post/index.php';
                }
            } else { ?>
                <tr>
                    <td colspan="3">Sorry but it looks like no one posted on your wall yet..</td>
                </tr>
            <?php } ?>
	</table>


	</div>
<br />