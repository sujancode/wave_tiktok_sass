@extends('theme::layouts.app')


@section('content')
	
	<div class="flex flex-col px-8 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5">
	    <div class="flex flex-col justify-start flex-1 mb-5 overflow-hidden bg-white border rounded-lg lg:mr-3 lg:mb-0 border-gray-150">
	        <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
			<div>
				<input type="text" id="post_url" name="post_url" placeholder="Enter Reddit Post URL"/>
				<button id="generate_video">Generate Video</button>
			</from>
			</div>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>
	<script>

		// var saveData = (function () {
		// 	var a = document.createElement("a");
		// 	document.body.appendChild(a);
		// 	a.style = "display: none";
		// 	return function (data, type,fileName) {
		// 		var	blob = new Blob([data], {type: type});
		// 		var url = window.URL.createObjectURL(blob);
		// 		a.href = url;
		// 		a.download = fileName;
		// 		a.click();
		// 		window.URL.revokeObjectURL(url);
		// 	};
		// }());

		var link="http://3.86.86.193:8000/reddit/get-video/"

		var generate_btn=document.getElementById("generate_video")
		
		generate_btn.onclick=(e)=>{
			var url=document.getElementById("post_url").value

			post_id=url.split("/")[6]
			console.log(post_id)
			if (!post_id){
				alert("Enter Valid URL")
				return
			}
			var bodyFormData = new FormData();
			bodyFormData.append('username', 'sujan');
			bodyFormData.append('post_id', post_id);

			axios({
				method: 'post',
				url: link,
				data:bodyFormData
			}).then(response=>{
				console.log(response)
				filename=response["data"]["path"].replaceAll(" ","+")
				var video_path=`https://redditvideobucket.s3.amazonaws.com/${filename}`
				// saveData(response.data,"mp4","video.mp4")
				window.open(video_path,"_blank")
			}).catch(err=>{
				console.log("Error Has Occured")
				console.log(err)
			});
		}
	</script>
@endsection
