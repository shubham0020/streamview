/** VIDEO LOGIC HERE **/

/* Get our elements */
const player = window.jwplayer('my-unique-id'),
      video = window.jwplayer('.my-unique-id'),
      progress = window.jwplayer('.progress'),
      progressBar = window.jwplayer('.progress__filled'),
      toggle = window.jwplayer('.toggle'),
      skipButtons = 0,
      ranges = 0;


/* Functions */

function togglePlay(){
  if(video.paused){
    video.play();
  } else{
    video.pause();
  }
}

function playerForward() {
    const player = window.jwplayer('my-unique-id');

    console.log(player.getPosition());

}
function updatePlayButton(){
  const icon = this.paused ? '<i class="fas fa-play"></i>' : '<i class="fas fa-pause"></i>';
  toggle.innerHTML = icon;
}

function skip() {
  video.currentTime += parseFloat(this.dataset.skip);
}

function rangeUpdate(){
  // this.name = volume or playbackRate
  video[this.name] = this.value;
}

function handleProgress(){
  const percent = (video.currentTime / video.duration) * 100;
  progressBar.style.width = `${percent}% `;
}

function scrub(e) {
  const scrubTime = (e.offsetX / progress.offsetWidth) * video.duration;
  video.currentTime = scrubTime;
}


/* Event listeners */

// // Play/pause clicking on the video
// video.addEventListener('click', togglePlay);
// // Update play button icon
// video.addEventListener('play', updatePlayButton);
// video.addEventListener('pause', updatePlayButton);
// // Update the progress bar
// video.addEventListener('timeupdate', handleProgress);
// // Click on the progress bar
// progress.addEventListener('click', scrub);
// // Play/pause clicking on the play video
// toggle.addEventListener('click', togglePlay);
// // Skip buttons
// skipButtons.forEach(button => button.addEventListener('click', skip));
// // Ranges Update
// ranges.forEach(range => range.addEventListener('change', rangeUpdate));
// ranges.forEach(range => range.addEventListener('mousemove', rangeUpdate));

