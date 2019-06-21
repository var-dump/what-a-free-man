<?php
	$result = $PDO->query('select * from pro');
    $pro = $result->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>三级联动</title>
</head>
<body>
<select id="pro">
	<option>请选择</option>
<? foreach($pro as $val){ ?>
	<option value="<? echo $val['provinceID']; ?>">
		<? echo $val['province']; ?>
	</option>
<? } ?>
</select>
<select id="city" style="display:none;"></select>
<select id="town" style="display:none;"></select>

<script src="../style/js/jquery-3.1.1.min.js"></script>
<script>
	$("#pro").change(function(){
		$("#city").css("display","none");
		$("#town").css("display","none");
		proChange();
	});
	
	$("#city").change(function(){
		cityChange();
	});
	
	function proChange()
	{
		var proVal = $("#pro").val();
		// alert(proVal);
		$.ajax({
			async:false,
			type:"post",
			url:"<?echo __DIR__?>/ajax/city.php",
			datatype:"json",
			data:{"val":proVal},
			success:function(data)
			{
				if(data != 1)
				{
					$("#city").css("display","block");
				}
				data = JSON.parse(data);
				var str="<option value=''>二级</option>";
				for(var i=0;i<data.length;i++)
				{
					str += "<option value="+data[i].cityID+">"+data[i].city+"</option>";
				}
				$("#city").html(str);
			},
			error:function (XMLHttpRequest)
			{
				alert("出错嘞");
			}
		});
	}
	
	function cityChange()
	{
		var cityVal = $("#city").val();
		$.ajax({
			async:false,
			type:"post",
			url:"ajax/town.php",
			datatype:"json",
			data:{"val":cityVal},
			success:function(data)
			{
				if(data == 1)
				{
					$("#town").css("display","none");
					return false;
				}
				data = JSON.parse(data);
				$("#town").css("display","block");
				var str="<option value=''>三级</option>";
				for(var i=0;i<data.length;i++)
				{
					str += "<option value="+data[i].areaID+">"+data[i].area+"</option>";
				}
				$("#town").html(str);
			},
			error:function (XMLHttpRequest)
			{
				alert("出错嘞");
			}
		});
	}
</script>
</body>
</html>