liff.init(
    {
      liffId: "1654195194-732m4xvP",
    },
    () => {
      if (liff.isLoggedIn()) {
        runApp();
      } else {
        liff.login();
      }
    },
    (err) => console.error(err.code, error.message)
  );
  
  function runApp() {
    liff
      .getProfile()
      .then((profile) => {
        id = profile.userId;
        console.log(id);
        getprofile(id);
      })
      .catch((err) => {
        console.log("error", err);
      });
  }
  function getprofile(id) {
    console.log(id);
  
    $.ajax({
      url: "Login.php",
      type: "POST",
      data: {
        userId: id,
      },
    success: function (result) {
      if (result == 1) {
        swal({
          title: "ไว้โอกาสหน้าใช้งานใหม่นะครับ",
          text: "เราจะรอคุณกลับมาเสมอ",
          icon: "success",
          button: "OK!",
        }).then((value) => {
          liff.closeWindow();
        });
      } else {
        swal({
            title: "ผิดพลาด",
            text: result,
            icon: "Error",
            button: "OK!",
          }).then((value) => {
            liff.closeWindow();
          });
      }
    },
  });
}
