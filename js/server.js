function b64EncodeUnicode(str) {
    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g, function(match, p1) {
        return String.fromCharCode('0x' + p1);
    }));
}

var apply = {
    basic: function() {
       
        var customtext = document.getElementById("customtext").value;
        var code = document.getElementById("content").value;
        var code = b64EncodeUnicode(code);
        var mode = document.getElementById("mode").value;
        var filename = document.getElementById("filename").value;
        
        var a = "editor= "+code+"&filename="+filename+"&mode="+mode+"&customtext="+customtext;

        $.ajax({
            url: "/wipro/server/server.php",
            type: "POST",
            data: a,
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            beforeSend: function() {},
            complete: function() {},
            error: function(a, b, c) {
                console.log(c);
            },
            success: function(a, b, c) {
                var decodedString = atob(a);

                document.getElementById("outputdisplay").innerHTML = " "+decodedString+"";
                 
                
                
            }
        });
    }
};



$(document).on('click', '#run', function() {

    apply.basic();

});