<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>

<body>
    <div class="container">

        <div class="row">
            <div class="col-xl-8 shadow-lg p-3 mb-5 bg-white rounded">
                <div class="row">
                    <div class="col-xl-12 ">
                        <form id="verifyForm">

                            <div class="row">
                                <div class="col-xl-3">
                                    <label>Yasaklı Kelime Giriniz</label>
                                    <input type="text" id="TxtForbiddenWord" class="form-control" value="" />
                                </div>
                                <div class="col-xl-2">
                                    <label>&nbsp</label>
                                    <input type="button" class="btn btn-primary form-control" value="Ekle" onClick="forbiddenWord()" />
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <label>Paragraf Giriniz</label>
                        <textarea class="form-control" id="TxtParagraph" rows="5" "></textarea>
                    </div>
                </div>
                <div class=" row pt-xl-3">
                    <div class="col-xl-3">

                        <input type="button" class="btn btn-primary form-control" value="Bul" onClick="findForbiddenWord()" />
                    </div>
                </div>
                <div class="row pt-xl-3">
                    <div class="col-xl-3 clasNewParag">

                    </div>
                </div>
            </div>
            <div class="col-xl-4 shadow p-3 mb-5 bg-white rounded">
                <label>Yasaklı Kelime Listesi</label>
                <ul class="list-group">
                </ul>
            </div>
        </div>


    </div>

    <script type="text/javascript" src="assets/js/jquery-3.5.1.slim.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script>
        var TxtForbiddenWord;
        var TxtParagraph;
        var ForbiddenList= [];
     
        function forbiddenWord() {
            TxtForbiddenWord = $('#TxtForbiddenWord').val();
            if ($('#TxtForbiddenWord').val() != "") {
                $('.list-group').append("<li class='list-group-item'>" + TxtForbiddenWord + "</li> ");
            if(TxtForbiddenWord.includes(",") )
            {
                var result =TxtForbiddenWord.split(",");
                result.forEach(function(value,key){
                    if(value.includes(" "))
                    {
                        var result2 =value.split(" ");                   
                   
                        console.log(value);
                        result2.forEach(function(value2,key){
                        ForbiddenList.push(value2);
                        });
                    } else{
                        ForbiddenList.push(value);
                    }
                   
                 });
            }  
            else{               
            ForbiddenList.push(TxtForbiddenWord);
            $('.list-group').append("<li class='list-group-item'>" + TxtForbiddenWord + "</li> ");           
            }                              
            }
            $('#TxtForbiddenWord').val(""); 
        }

        function findForbiddenWord() {
            console.log(ForbiddenList)
            if ($('#TxtParagraph').val() != "") {
                TxtParagraph = $('#TxtParagraph').val();
                $.ajax({
                    type:'POST',
                    url:'controller/IndexController.php',
                    data:{
                        "TxtForbiddenWord": $('#TxtForbiddenWord').val(),
                        "TxtParagraph": $('#TxtParagraph').val(),
                        "ForbiddenList":ForbiddenList
                    },
                    success:function(result) {
                       console.log(result);
                       $('.clasNewParag').append("<p>"+result+"</p>");
                    }
                });
                
            } else {
                alert('Lütfen Paragraf Giriniz.')
            }

        }
    </script>
</body>

</html>