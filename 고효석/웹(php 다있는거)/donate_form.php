<script
      type="text/javascript"
      src="https://code.jquery.com/jquery-1.12.4.min.js"
    ></script>
    <!-- iamport.payment.js -->
    <script
      type="text/javascript"
      src="https://cdn.iamport.kr/js/iamport.payment-1.2.0.js"
    ></script>

<script>
    var IMP = window.IMP; // 생략가능
    IMP.init('imp14462318'); 

    var today = new Date();   
    var hours = today.getHours(); // 시
    var minutes = today.getMinutes();  // 분
    var seconds = today.getSeconds();  // 초
    var milliseconds = today.getMilliseconds();
    var makeMerchantUid = hours +  minutes + seconds + milliseconds;

    function donate() {
        IMP.request_pay({
        pg : 'danal_tpay', // version 1.1.0부터 지원.
        pay_method : 'card',
        merchant_uid : 'merchant_' + makeMerchantUid,
        name : 'Diary For Me 후원',
        amount : 1000,
        buyer_email : '',
        buyer_name : '',
        buyer_tel : '',
        buyer_addr : '',
        buyer_postcode : '',
        }, function(rsp) {
        if ( rsp.success ) {
            var msg = '결제가 완료되었습니다.';
            msg += '결제 금액 : ' + rsp.paid_amount;
        } else {
            var msg = '결제에 실패하였습니다.';
            msg += '에러내용 : ' + rsp.error_msg;
        }
        alert(msg);
        });
    }
</script>
      <div id="main_content">
            <div id="logo_img">
                <img src="./img/logo.png">
            </div>

            <div id = "messege_for_supportor">
                Dairy For Me 서비스가 마음에 드셨다면 후원해주세요!<br>
                작은 후원이 어린 제작자를 춤추게 만듭니다!
            </div>
            <div id = "donate_btn">
            <button onclick="donate()">후원하기</button>
            </div>
        </div>

