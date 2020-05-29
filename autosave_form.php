<html>
    <head>
        <title>Auto Form Save</title>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    </head>
    <body>
        <form id="auto-save-form">
            Name : <input name="name" type="text" />
            Email : <input name="email" type="text">
            <input name="submit" type="submit"/>
        </form>
        <script type="text/javascript">
            /*Form Auto Submit Logic*/
            var changeFlag = false;
            var focusFlag = false;
            jQuery("#auto-save-form").change(function () {
                changeFlag = true;
                focusFlag = false;
            });
            setInterval(function () {
                /*
                 * changeFlag for change any element of current form
                 * focusFlag for tell us that focus out or in
                 */
                if (changeFlag == true && focusFlag == false) {
                    jQuery("#auto-save-form").trigger("submit");
                    changeFlag = false;
                }
            }, 3000);
            jQuery("#auto-save-form input").focus(function () {
                focusFlag = true;
            });
            jQuery("#auto-save-form input").focusout(function () {
                focusFlag = false;
            });
            /*Form Auto Submit Logic End*/
            $("#auto-save-form").submit(function () {
                alert("submitted");
                //Ajax Logic
            });
        </script>
    </body>
</html>