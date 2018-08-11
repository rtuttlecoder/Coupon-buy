
<head>

<script src="text/javascript">
// Do not name the function "play()"
function playVideo(){
    var video = document.getElementById('video');
    video.play();
    video.addEventListener('ended',function(){
        window.location = 'http://www.google.com';
    });
}
</script></head>

<video controls id="video" width="770" height="882" onclick="playVideo()">
    <source src="http://www.managecoupon.com/mc_demo.mp4" type="video/mp4" />
</video>



