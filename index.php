<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <title>ATM</title>
</head>
<?php
$placeholder = "5, 10, 20, 50, 100, 200, 500";
?>

<body>
    <div class="atm">
        <h2 class="atm__title">Банкомат</h2>
        <form action="#" method="POST" id="form" onsubmit="return false">
            <div class="block__nominal">
                <label for="nominal">Номинал в наличии <br>
                    <input type="text" class="nominal" name="nominal" value="<?php echo ($placeholder) ?>" readonly>
                </label>
            </div>
            <div class="block__summa"> <label for="summa">ваша сумма <br>
                    <input type="text" class="summa" name="summa" placeholder="введите сумму" required pattern="^[ 0-9]+$">
                </label></div>
            <input type="submit" class="button" name="button">

        </form>
    </div>
    <div class="answer">
        <div class="inner__answer">
            <div class="table" style="display: flex;">
                <div class="div">
                    <h3>Номинал</h3>
                    <div id="tr">

                        <p id="id_td_nominal"></p>
                    </div>
                </div>

                <div class="div">
                    <h3>Количество</h3>
                    <div id="tr_count">

                        <p id="id_td_count"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="message">
        <script>
            $("#form").on("submit", function() {
                $.ajax({
                    url: './php/post.php',
                    method: 'post',
                    dataType: 'html',
                    data: $(this).serialize(),
                    success: function(data) {
                        if (data[0] == 'A') {
                            let strNull = "=>";
                            let nominal = [];
                            let count = [];
                            let resultNominal = [];
                            let resultCount = [];
                            let str = data;
                            let newStr = str.split(" ");
                            //перебираем данные из post.php
                            for (let i = 0; i < newStr.length; i++) {
                                if (newStr[i] == strNull) {
                                    nominal.push(newStr[i - 1]);
                                    count.push(newStr[i + 1]);
                                }
                            }
                            // преобразуем массив count 
                            for (let i = 0; i < count.length; i++) {
                                let itemCount = count[i].split(" ");
                                resultCount.push(itemCount.join(""));

                            }
                            //console.log(resultCount[resultCount.length-1]);
                            let endCountValue = resultCount[resultCount.length - 1];
                            let NewEndCountValue = endCountValue.split("");
                            endCountValue = NewEndCountValue[0];
                            resultCount.splice(resultCount.length - 1, 1, endCountValue)

                            // добавляем новые <p> с значения  resultCount
                            for (let i = 0; i < resultCount.length; i++) {
                                let parent = document.querySelector('#tr_count');
                                let before = document.querySelector('#id_td_count');
                                let p = document.createElement('p');
                                p.innerHTML = resultCount[i];
                                parent.insertBefore(p, before);
                            }
                            // преобразуем массив nominal
                            for (let i = 0; i < nominal.length; i++) {
                                let itemNominal = nominal[i].split("");
                                itemNominal.splice(0, 1);
                                itemNominal.splice(itemNominal.length - 1, 1);
                                resultNominal.push(itemNominal.join(""));

                            }
                            // добавляем новые <p> с значения  resultNominal
                            for (let i = 0; i < resultNominal.length; i++) {
                                let parent = document.querySelector('#tr');
                                let before = document.querySelector('#id_td_nominal');
                                let p = document.createElement('p');
                                p.innerHTML = resultNominal[i];
                                parent.insertBefore(p, before);
                            }
                        } else {
                            data = Number(data);

                            function bigSumma(data) {
                                while ((data % 5) !== 0) {
                                    data++;
                                }
                                return data
                            }

                            function litleSumma(data) {
                                while ((data % 5) !== 0) {
                                    data--;
                                }
                                return data
                            }

                            let tableBlock = document.querySelector(".table");
                            let innerAnswer = document.querySelector(".inner__answer"); //parent
                            tableBlock.style.display = 'none';
                            let p = document.createElement('p');
                            p.innerHTML = `Неверная сумма введите ${litleSumma(data)} или ${bigSumma(data)}`;
                            innerAnswer.insertBefore(p, tableBlock);

                        }
                    }
                });
            });
        </script>

    </div>
   
</body>

</html>