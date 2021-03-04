function ReadArticle(content_id) {
  console.log(content_id);
  window.location.replace("proc_insert_progress.php?content_id=" + content_id);
}
function ReadEvents(event_id) {
  console.log(event_id);
  window.location.replace("proc_prog_events.php?content_id=" + event_id);
  console.log(content_id);
}
function WatchedVideos(media_id) {
  window.location.replace("proc_insert_prog_media.php?mediaId=" + media_id);
}
function WatchedAudio(media_id) {
  window.location.replace("proc_insert_prog_audio.php?mediaId=" + media_id);
}
function HomeContentClicked(content_id) {
  console.log(content_id);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //console.log(this.responseText);
    }
  };
  xmlhttp.open(
    "GET",
    "proc_insert_prog_home.php?content_id=" + content_id,
    true
  );
  xmlhttp.send();
}

function VideoCheck() {
  for (var i = 0; i < 3; i++) {
    switch (i) {
      case 0:
        trimFun("videoTitle", "Video Title");
        break;
      case 1:
        trimFun("video-description", "video Description");
        break;
      case 2:
        if (document.getElementById("video_file").files.length == 0) {
          count += 1;
          msg += "Video" + " required " + "\n";
        }
        break;
    }
  }
  if (count > 0) {
    $("#myModal").modal();
    document.getElementById("alert_message").textContent = msg;
    count = 0;
    msg = "";
    return false;
  } else {
    return true;
  }
}
function AudioCheck() {
  for (var i = 0; i < 3; i++) {
    switch (i) {
      case 0:
        trimFun("soundTitle", "Audio Title");
        break;
      case 1:
        trimFun("audio-description", "Audio Description");
        break;
      case 2:
        if (document.getElementById("sound_file").files.length == 0) {
          count += 1;
          msg += "Audio File" + " required " + "\n";
        }
        break;
    }
  }
  if (count > 0) {
    $("#myModal").modal();
    document.getElementById("alert_message").textContent = msg;
    count = 0;
    msg = "";
    return false;
  } else {
    return true;
  }
}
function trimFun(id, message) {
  var Value = document.getElementById(id).value;
  Value = Value.trim();
  if (Value == "") {
    msg += message + " required " + "\n";
    count += 1;
  }
}

function CheckResetPassword() {
  let password = document.getElementById("newpwd").value;
  let confirm = document.getElementById("cnfpwd").value;
  if (password != confirm) {
    $("#ErrormyModal").modal();
    document.getElementById("alert_message").textContent =
      "Password Not maching";
    return false;
  }
  return true;
}
function checkCode() {
  let code = document.getElementById("code").value;
  let email = document.getElementById("email").value;
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //   console.log(this.responseText); //success message :)
      let result = this.responseText;
      if (result === "1") {
        // console.log("here");
        document.getElementById("mail").value = email;
        document.getElementById("ForgetPwd").style.display = "block";
        document.getElementById("checkCodeForm").style.display = "none";
      } else {
        $("#ErrormyModal").modal();
        document.getElementById("alert_message").textContent =
          "Wrong Credentials";
      }
    }
  };
  xhttp.open(
    "GET",
    "proc_check_code.php?email=" + email + "&code=" + code,
    true
  );
  xhttp.send();
  //   if (code === "123") {
  //     document.getElementById("ForgetPwd").style.display = "block";
  //     document.getElementById("checkCodeForm").style.display = "none";
  //   }
}
$("[data-toggle=popover]").popover();
$(document).on("click", "#hi", function (event) {
  let id = 0;
  if (event.target.parentNode.id == "hi") {
    id = event.target.parentNode.firstChild.id;
  } else {
    id = event.target.parentNode.id;
  }
  window.location.replace("proc_insert_progress.php?content_id=" + id);
});

$(".popover-dismiss").popover({
  trigger: "focus",
});
