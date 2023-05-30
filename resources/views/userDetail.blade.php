<!DOCTYPE html>
<html>

<head>
    <title>User Detail</title>
</head>

<body>
    <div class="row">
        <center>
            <h2>Detail Data</h2>
            <h5><b>No Account: {{ $userId }}</b></h5>
        </center>
    </div>



    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/material.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/lang/de_DE.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/geodata/germanyLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/fonts/notosans-sc.js"></script>
    <script src="//cdn.amcharts.com/lib/4/core.js"></script>
    <script src="//cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="//cdn.amcharts.com/lib/4/plugins/forceDirected.js"></script>
    <script>
        var chart = am4core.create("chartdiv", am4plugins_forceDirected.ForceDirectedTree);

        var dataJson = <?php echo json_encode($listTransaction); ?>;
        var userJson = <?php echo json_encode($userAccount); ?>;
        var hasilPredictJSOn = <?php echo json_encode($suspiciousAccounts); ?>;
        var userId = "<?php echo $userId; ?>";
        var userPartyType = "";
        var userIsSar = "";
        var userCountry = "";
        var userPekerjaan = "";
        var userNamaBank = "";

        userJson.forEach(element => {
            if (element.partyId == userId) {


                if (element.partyType == 0) {
                    userPartyType = "Individual";
                } else {
                    userPartyType = "Organization";
                }

                userCountry = element.country;
                userPekerjaan = element.pekerjaan;
                userNamaBank = element.nama_bank;
                userIsSar = "Terlibat";
            }
        })

        var data = [{
            "name": userId,
            "PartyType": userPartyType,
            "IsSar": userIsSar,
            "Country": userCountry,
            "Pekerjaan": userPekerjaan,
            "NamaBank": userNamaBank,
            "color": "#FF0000",
            "children": []
        }];

        dataJson.forEach(element => {
            var child = {};

            var sourcePartyType = "";
            var sourceIsSar = "";
            var sourceCountry = "";
            var sourcePekerjaan = "";
            var sourceNamaBank = "";

            var targetPartyType = "";
            var targetIsSar = "";
            var targetCountry = "";
            var targetPekerjaan = "";
            var targetNamaBank = "";

            var color = "";

            var risk = "";

            if (element.source == userId) {
                userJson.forEach(account => {
                    if (account.partyId == element.target) {
                        if (account.partyType == 0) {
                            targetPartyType = "Individual";
                        } else {
                            targetPartyType = "Organization";
                        }

                        if (account.is_sar == 0) {
                            targetIsSar = "Tidak terlibat";

                        } else {
                            targetIsSar = "Terlibat";

                        }

                        targetCountry = account.country;
                        targetPekerjaan = account.pekerjaan;
                        targetNamaBank = account.nama_bank;
                        hasilPredictJSOn.forEach(akun =>{
                            if(akun.userAccount == element.target){
                                color = "#FFFF00";
                            }
                        })
                    }
                })

                child = {
                    "name": element.target,
                    "value": element.weight,
                    "PartyType": targetPartyType,
                    "IsSar": targetIsSar,
                    "Country": targetCountry,
                    "Pekerjaan": targetPekerjaan,
                    "NamaBank": targetNamaBank,
                    "color": color
                };
            } else {
                userJson.forEach(account => {
                    if (account.partyId == element.source) {
                        if (account.partyType == 0) {
                            sourcePartyType = "Individual";
                        } else {
                            sourcePartyType = "Organization";
                        }

                        if (account.is_sar == 0) {
                            sourceIsSar = "Tidak terlibat";

                        } else {
                            sourceIsSar = "Terlibat";

                        }

                        sourceCountry = account.country;
                        sourcePekerjaan = account.pekerjaan;
                        sourceNamaBank = account.nama_bank;

                        hasilPredictJSOn.forEach(akun =>{
                            if(akun.userAccount == element.target){
                                color = "#FFFF00";
                            }
                        })
                    }
                })

                child = {
                    "name": element.source,
                    "value": element.weight,
                    "PartyType": sourcePartyType,
                    "IsSar": sourceIsSar,
                    "Country": sourceCountry,
                    "Pekerjaan": sourcePekerjaan,
                    "NamaBank": sourceNamaBank,
                    "color": color
                };
            }
            data[0].children.push(child);
        });

        var series = chart.series.push(new am4plugins_forceDirected.ForceDirectedSeries());

        series.dataFields.value = "value";
        series.dataFields.name = "name";
        series.dataFields.children = "children";
        series.dataFields.color = "color";

        series.nodes.template.label.text = "{name}";
        series.fontSize = 16;
        series.minRadius = 30;
        series.maxRadius = 60;
        series.nodes.template.tooltipText =
            "UserId: {name} \n Total transaction: {value} \n country: {Country} \n Account Type: {PartyType} \n Keterlibatan : {IsSar}\n Pekerjaan: {Pekerjaan} \n Nama Bank: {NamaBank}"
        chart.data = data;
    </script>

    <div id="chartdiv" style="height:325px"></div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Source Account</th>
                <th scope="col">Transaction</th>
                <th scope="col">Target Account</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listTransaction as $t)
                <tr>
                    <td>{{ $t->source }}</td>
                    <td>{{ $t->weight }}</td>
                    <td>{{ $t->target }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
