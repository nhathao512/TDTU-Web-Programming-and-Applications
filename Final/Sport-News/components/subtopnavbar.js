function subTopNavbar() {
  return `
  <div class="sub-top-navbar">
  <div id="sub-top-navbar-espn-logo">
  <a href="./index.html" id="indexid"><img
  src="https://wassets.hscicdn.com/static/images/logo.png"
  alt="ESPN loog"/></a>
  </div>
  <div>
    <div class="dropdown">
      <button class="dropdown-btn">Tiện ích bóng đá</button>
      <div class="dropdown-content-1">
        <a href="#">Lịch thi đấu bóng đá</a>
        <a href="#">Kết quả bóng đá</a>
        <a href="#">Nhận định bóng đá</a>
        <a href="#">Tỷ số bóng đá</a>
        <a href="#">Trực tiếp bóng đá</a>
        <a href="#">Chuyển nhượng bóng đá</a>
        <a href="#">Video thể thao</a>
      </div>
    </div>
    <div class="dropdown">
      <button class="dropdown-btn">Giải đấu nổi bật</button>
      <div class="dropdown-content-2">
        <a href="#">Ngoại hạng Anh</a>
        <a href="#">Cúp C1</a>
        <a href="#">La liga</a>
        <a href="#">Serie A</a>
        <a href="#">Bundesliga</a>
        <a href="#">V League</a>
        <a href="#">World Cup</a>
        <a href="#">Euro</a>
        <a href="#">Asisan Cup</a>
        <a href="#">Cup C2</a>
        <a href="#">SEA Games</a>
        <a href="#">AFF Cup</a>
        <a href="#">Bóng đá Việt Nam</a>
      </div>
    </div>
    <div class="dropdown">
      <button class="dropdown-btn">Bảng Xếp Hạng Bóng Đá</button>
      <div class="dropdown-content-3">
        <a href="#">BXH Ngoại Hạng Anh</a>
        <a href="#">BXH La Liga</a>
        <a href="#">BXH Ý</a>
        <a href="#">BXH Cúp C1</a>
        <a href="#">BXH Cúp C2</a>
        <a href="#">BXH Đức</a>
        <a href="#">BXH Pháp</a>
        <a href="#">BXH V League</a>
      </div>
    </div>

    <div class="dropdown">
      <button class="dropdown-btn">Kết Quả Bóng Đá</button>
      <div class="dropdown-content-4">
        <a href="#">Kết quả Cúp C1</a>
        <a href="#">Kết quả Ngoại hạng Anh</a>
        <a href="#">Kết quả bóng đá Ý</a>
        <a href="#">Kết quả bóng đá Tây Ban Nha</a>
        <a href="#">Kết quả bóng đá Đức</a>
        <a href="#">Kết quả bóng đá Pháp</a>
        <a href="#">Kết quả Cúp C2</a>
      </div>
    </div>

    <div class="dropdown">
      <button class="dropdown-btn">Thể Thao Tổng Hợp</button>
      <div class="dropdown-content-5">
        <a href="#">Bóng chuyền</a>
        <a href="#">Quần vợt</a>
        <a href="#">Esports</a>
        <a href="#">Xe cộ</a>
        <a href="#">Võ</a>
      </div>
    </div>
    
  </div>
  <div>
    <div class="fantasy-logo">
      <a href="#"><i class="fa fa-user-circle" aria-hidden="true"></i></a>
      <button id="fantasy-logo-btn">Login</button>
    </div>
  </div>
</div>
    `;
}

export default subTopNavbar;
