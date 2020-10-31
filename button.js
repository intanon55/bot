//กดแล้วทำหน้าที่ส่งข้อมูลไปinsertเพื่อเข้าDB
// CkecIn
$("#checkin").click(function () {
    // $("#checkin").hide();
  
    liff.init(
      {
        liffId: "1654195194-732m4xvP",
      },
      liff
        .getProfile()
        .then((profile) => {
          id = profile.userId;
          email = liff.getDecodedIDToken().email;
        })
        .catch((err) => {
          console.log("error", err);
        })
    );
  
    setTimeout(() => {
      $.ajax({
        url: "insertIn.php",
        type: "POST",
        data: {
          userIn: id,
          emailIn: email,
        },
  
        success: function (result) {
          // swalคือalertแบบสวยงาม
          swal({
            title: "success!!!",
            text: result,
            icon: "success",
            button: "Yeah!",
          })
          .then((value) => {
            liff.closeWindow();
          });
          // closeWindow;
          // , (window.location.href = "/check-in.php");
  
          // console.log(result);
        },
      });
    }, 250);
  });
  
  // Report
  
  // function runApp() {
  //   liff
  //     .getProfile()
  //     .then((profile) => {
  //       document.getElementById("pictureUrl").src = profile.pictureUrl;
  // document.getElementById("userId").innerHTML =
  //   "<b>UserId:</b> " + profile.userId;
  // document.getElementById("displayName").innerHTML =
  //   "<b>DisplayName:</b> " + profile.displayName;
  // document.getElementById("statusMessage").innerHTML =
  //   "<b>StatusMessage:</b> " + profile.statusMessage;
  // document.getElementById("getDecodedIDToken").innerHTML =
  //   "<b>Email:</b> " + liff.getDecodedIDToken().email;
  // id = profile.userId;
  // console.log(id);
  // $.ajax();
  //     })
  //     .catch((err) => console.error(err));
  
  //   // $.ajax({
  //   //   url: "index.php",
  //   //   type: "POST",
  //   //   data: {
  //   //     userIn: id,
  //   //   },
  //   // });
  // }
  // liff.init(
  //   {
  //     liffId: "1654474033-wYMyONgd",
  //   },
  //   () => {
  //     if (liff.isLoggedIn()) {
  //       runApp();
  //     } else {
  //       liff.login();
  //     }
  //   },
  //   (err) => console.error(err.code, error.message)
  // );
  