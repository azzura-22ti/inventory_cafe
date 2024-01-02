// Set new default font family and font color to mimic Bootstrap's default styling
(Chart.defaults.global.defaultFontFamily = "Nunito"),
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + "").replace(",", "").replace(" ", "");
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
        dec = typeof dec_point === "undefined" ? "." : dec_point,
        s = "",
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return "" + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || "").length < prec) {
        s[1] = s[1] || "";
        s[1] += new Array(prec - s[1].length + 1).join("0");
    }
    return s.join(dec);
}

// Bar Chart masuk
// Function for number formatting
function number_format(number, decimals, dec_point, thousands_sep) {
    // ... [number_format function code]
}

// Axios to fetch data for barang masuk
axios
    .get("http://localhost:8000/home/barang-masuk")
    .then((respMasuk) => {
        const dataMasuk = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        respMasuk.data.forEach((element) => {
            dataMasuk[element.month - 1] = element.total;
        });

        // Axios to fetch data for barang keluar
        axios
            .get("http://localhost:8000/home/barang-keluar")
            .then((respKeluar) => {
                const dataKeluar = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                respKeluar.data.forEach((element) => {
                    dataKeluar[element.month - 1] = element.total;
                });

                const maxData = Math.max(
                    ...dataMasuk.concat(dataKeluar),
                    10 // minimum value (in case all data is zero)
                );

                // Chart rendering for combined data
                var ctx = document.getElementById("myBarChart");
                var myCombinedBarChart = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: [
                            "Januari",
                            "Februari",
                            "Maret",
                            "April",
                            "Mei",
                            "Juni",
                            "Juli",
                            "Agustus",
                            "September",
                            "Oktober",
                            "November",
                            "December",
                        ],
                        datasets: [
                            {
                                label: "Barang Masuk",
                                backgroundColor: "#4e73df",
                                hoverBackgroundColor: "#2e59d9",
                                borderColor: "#4e73df",
                                data: dataMasuk,
                            },
                            {
                                label: "Barang Keluar",
                                backgroundColor: "#1cc88a",
                                hoverBackgroundColor: "#17a673",
                                borderColor: "#1cc88a",
                                data: dataKeluar,
                            },
                        ],
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                left: 10,
                                right: 25,
                                top: 25,
                                bottom: 0,
                            },
                        },
                        scales: {
                            xAxes: [
                                {
                                    time: {
                                        unit: "month",
                                    },
                                    gridLines: {
                                        display: false,
                                        drawBorder: false,
                                    },
                                    ticks: {
                                        maxTicksLimit: 6,
                                    },
                                    maxBarThickness: 60,
                                },
                            ],
                            yAxes: [
                                {
                                    ticks: {
                                        min: 0,
                                        max: maxData + 5,
                                        maxTicksLimit: 5,
                                        padding: 10,
                                        callback: function (
                                            value,
                                            index,
                                            values
                                        ) {
                                            return Math.round(value);
                                        },
                                    },
                                    gridLines: {
                                        color: "rgb(234, 236, 244)",
                                        zeroLineColor: "rgb(234, 236, 244)",
                                        drawBorder: false,
                                        borderDash: [2],
                                        zeroLineBorderDash: [2],
                                    },
                                },
                            ],
                        },
                        legend: {
                            display: true,
                            labels: {
                                fontColor: "#333",
                                fontSize: 12,
                            },
                        },
                        tooltips: {
                            enabled: true,
                            mode: "index",
                            intersect: false,
                            titleMarginBottom: 10,
                            bodySpacing: 8,
                            callbacks: {
                                label: function (tooltipItem, chart) {
                                    var datasetLabel =
                                        chart.datasets[tooltipItem.datasetIndex]
                                            .label || "";
                                    var value =
                                        chart.datasets[tooltipItem.datasetIndex]
                                            .data[tooltipItem.index];
                                    return (
                                        datasetLabel + ": " + Math.round(value)
                                    );
                                },
                            },
                        },
                    },
                });
            })
            .catch((error) => {
                console.error("Error fetching data barang keluar:", error);
            });
    })
    .catch((error) => {
        console.error("Error fetching data barang masuk:", error);
    });
