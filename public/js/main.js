 $(document).ready(function(){
        $("#add-row").click(function(){
            //var name = $("#name").val();
            //var email = $("#email").val();
            var markup = "<tr><th scope='row'>1</th><td>modify</td><td>delete</td><td></td><td></td><td></td><td></td></tr>";
            $("table tbody").append(markup);
        });
       
    }); 