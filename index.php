<?php
	$homepage = file_get_contents('https://raw.githubusercontent.com/charlesreid1/five-letter-words/master/sgb-words.txt');
	$data = explode("\n",$homepage);
	$len = count($data);
	$index = rand(0,$len-1);
	$finalWord = $data[$index];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Wordle Game</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body id="body">
	<div class="col-md-12">
		<div class="px-3 py-2 text-white">
			<div class="container  center-align">
				<h1 class="content">WORDLE</h1>
			</div>
	    </div>
	</div>
	<div class="col-created container">
		<div class="row mt-3 row1">		
			<div class="col-md-4">
				<input type="hidden" name="data" id="demo" value="<?php echo $finalWord ?>">
			</div>
			<div class="col">
				<input type="text" class="form-control size" name="t1" id="t1" onkeyup="movetoNext(this, 't2')" maxlength="1" autofocus>
			</div>
			<div class="col">
				<input type="text" class="form-control size" name="t2" id="t2" onkeyup="movetoNext(this, 't3')" maxlength="1">
			</div>
			<div class="col">
				<input type="text" class="form-control size" name="t3" id="t3" onkeyup="movetoNext(this, 't4')" maxlength="1">
			</div>
			<div class="col">
				<input type="text" class="form-control size" name="t4" id="t4" onkeyup="movetoNext(this, 't5')" maxlength="1">
			</div>
			<div class="col">
				<input type="text" class="form-control size" name="t5" id="t5" onkeyup="movetoNext(this, 'CheckBtn')" maxlength="1">
			</div>		
			<div class="col-md-2 remove">
				<button class="btn btn-link" onclick="checkValue()" id="CheckBtn" ><i class="fa-solid fa-circle-check"></i></button>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="col-md-12">
			<div class="keyboard_wrapper">
			    <div class="key">
			        <div class="row">
			            <span data-key="Q">Q</span>
			            <span data-key="w">w</span>
			            <span data-key="e">e</span>
			            <span data-key="r">r</span>
			            <span data-key="t">t</span>
			            <span data-key="y">y</span>
			            <span data-key="u">u</span>
			            <span data-key="i">i</span>
			            <span data-key="o">o</span>
			            <span data-key="p">p</span>
			        </div>
			        <div class="row">
			            <span data-key="a">a</span>
			            <span data-key="s">s</span>
			            <span data-key="d">d</span>
			            <span data-key="f">f</span>
			            <span data-key="g">g</span>
			            <span data-key="h">h</span>
			            <span data-key="j">j</span>
			            <span data-key="k">k</span>
			            <span data-key="l">l</span>
			        </div>
			        <div class="row">
			            <span data-key="z">z</span>
			            <span data-key="x">x</span>
			            <span data-key="c">c</span>
			            <span data-key="v">v</span>
			            <span data-key="b">b</span>
			            <span data-key="n">n</span>
			            <span data-key="m">m</span>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    	function movetoNext(current, nextFieldID) {  
	// 	if (current.value.length >= current.maxLength) {  
	// 	document.getElementById(nextFieldID).focus();  
	// 	}  
	}
	var count = 0;
	var dict = "<?php print_r(implode(",",$data)); ?>";
	let list = dict.split(',');
	let dictionary = Object.assign({}, ...list.map((x) => ({[count++]: x})));
	// console.log(dictionary);
	// let FinalWord = "hello";
	let FinalWord = document.getElementById('demo').value;
	console.log("Word To Check : ",FinalWord);
	const validString = FinalWord.split('');
	var ids	= 0;
	$("input[type='text']").keyup(function(e){
        var empty=true;
        $("input[type='text']").each(function(i){
            if($(this).val()=='')
            {
                empty=true;
                $('#CheckBtn').prop('disabled', true);
                return false;
            }
            else
            {
                empty=false;
            }
        });
        if(!empty) 
        	$('#CheckBtn').prop('disabled', false);
     });
	
	function checkValue(){
		var countToWin=0;
		var valid = FinalWord.split('');
		var flag = 0;
		$("input[type^='text']").each(function(i){
			if($(this).val() == ''){
				clear();
				flag = 1;
			}
		});
		if(flag === 1){
			Swal.fire({
				  icon: 'warning',
				  title: 'Oops...',
				  text: 'Please Enter Data Properly!'
				});
			$("input[name='t1']").focus()
			return;
		}
		var arr=[];
		arr.push($("input[name=t1]").val().toLowerCase());
		arr.push($("input[name=t2]").val().toLowerCase());
		arr.push($("input[name=t3]").val().toLowerCase());
		arr.push($("input[name=t4]").val().toLowerCase());
		arr.push($("input[name=t5]").val().toLowerCase());
		let check = arr.join("");
		check = check.toLowerCase();
		// console.log("Check =>",check);
		if(getKeyByValue(dictionary,check) === undefined){
			clear();
			Swal.fire({
				icon: 'info',
				title: 'Word Not in List'
			})
			return;
		}
		// var remain = [];
		for(let i=0;i<5;i++){
			if(arr[i] === valid[i]){
				let span = "span[data-key='"+arr[i]+"']";
				$(span).css('background-color','green');
				$(span).css('border','green');
				$(span).addClass("green");
				valid[i] = "|||";
				arr[i] = "???";
				//put green colour on correct placed letter
				let input = "input[name='t"+ (i+1) +"']";
				// console.log("inside green ",input);
				$(input).css('background-color','green');
				$(input).css('border','solid green');
				// remain[i] = '???';
				countToWin+=1;
			}
			if(countToWin == 5){
				win();
			}
			
		}
		for(let i=0;i<arr.length;i++){
			if(arr[i] !== "???"){
				let id = valid.indexOf(arr[i]);				
				if(id === undefined || id === -1){
					let input = "input[name=t"+ (i+1) +"]";
					// console.log(input);
					let span = "span[data-key='"+arr[i]+"']";
					if($(span).hasClass("green")){
						$(input).css('background-color','dimgrey');
						$(input).css('border','solid dimgrey');
						continue;
					}else if($(span).hasClass("yellow")){
						$(input).css('background-color','dimgrey');
						$(input).css('border','solid dimgrey');
						continue;
					}
					else {
						$(span).css('background-color','dimgrey');
						$(span).css('border','dimgrey');
					}
					$(input).css('background-color','dimgrey');
					$(input).css('border','solid dimgrey');
					// console.log("valid => ",valid)
				}else{
					valid[id] = "|||";
					$("span[data-key='"+arr[i]+"']").addClass("yellow");
					$("span[data-key='"+arr[i]+"']").css('background-color','yellow');
					$("span[data-key='"+arr[i]+"']").css('border','yellow');
					let input = "input[name=t"+ (i+1) +"]";
					$(input).css('background-color','yellow');
					$(input).css('border','solid yellow');
				}
			}
		}
		$(".green , .yellow").removeClass();
		$("input[type^='text']").each(function(i){
			$(this).prop('disabled',true);
		});
		// $(".size").removeClass();
		$( "div" ).remove( ".remove" );
		$(".size").removeAttr("name")
		if(ids < 5 ){
			append();
			ids++;
		}
		if( ids === 6){
			Swal.fire({
				icon: 'info',
				title: 'Hard Luck!',
				text: 'You Lost The Challenge',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Okay'
			}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire(
					'',
					'Thank You For Playing',
					'success'
					)
				}
			}).then(function(){ 
			   location.reload();
			})
		}
		valid = validString;
	}
	function win(){
		Swal.fire({
				icon: 'success',
				title: 'Hurray!!',
				text: 'You Won The Challenge',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Okay'
			}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire(
					'Success!',
					'Thank You For Playing',
					'success'
					)
				}
			}).then(function(){ 
			   location.reload();
			})
	}
	function getKeyByValue(object, value) {
		return Object.keys(object).find(key => object[key] === value);
	}
	function clear(){
		$("input[name=t1]").val("");
		$("input[name=t2]").val("");
		$("input[name=t3]").val("");
		$("input[name=t4]").val("");
		$("input[name=t5]").val("");
	}
	function append(){
       $('<div class="row mt-3 row1">'+
       	'<div class="col-md-4"></div>'+
       	'<div class="col"><input type="text" class="form-control size" name="t1" id="t1" maxlength="1" autofocus></div>'+     	
       	'<div class="col"><input type="text" class="form-control size" name="t2" id="t2" maxlength="1"></div>'+           	
       	'<div class="col"><input type="text" class="form-control size" name="t3" id="t3" maxlength="1"></div>'+           	
       	'<div class="col"><input type="text" class="form-control size" name="t4" id="t4" maxlength="1"></div>'+           	
       	'<div class="col"><input type="text" class="form-control size" name="t5" id="t5" maxlength="1"></div>'+
       	'<div class="col-md-2 remove "><button class="btn btn-link" onclick="checkValue()" id="CheckBtn">'+
       	'<i class="fa-solid fa-circle-check"></i></button></div>'+
       	'</div>').appendTo(".col-created");
	}
</script>