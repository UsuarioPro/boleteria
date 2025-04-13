// Define el tema dark-unica en una variable
var darkUnicaTheme = {
    colors: [
        "#2b908f",
        "#90ee7e",
        "#f45b5b",
        "#7798BF",
        "#aaeeee",
        "#ff0066",
        "#eeaaee",
        "#55BF3B",
        "#DF5353",
        "#7798BF",
        "#aaeeee"
    ],
    chart: {
        backgroundColor: {
            linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
            stops: [
                [0, "#343a40"],
                [1, "#343a40"]
            ]
        },
        style: { fontFamily: "'Unica One', sans-serif" },
        plotBorderColor: "#606063"
    },
    title: {
        style: {
            color: "#E0E0E3",
            textTransform: "uppercase",
            fontSize: "20px"
        }
    },
    subtitle: {
        style: { color: "#E0E0E3", textTransform: "uppercase" }
    },
    xAxis: {
        gridLineColor: "#707073",
        labels: { style: { color: "#E0E0E3" } },
        lineColor: "#707073",
        minorGridLineColor: "#505053",
        tickColor: "#707073",
        title: { style: { color: "#A0A0A3" } }
    },
    yAxis: {
        gridLineColor: "#707073",
        labels: { style: { color: "#E0E0E3" } },
        lineColor: "#707073",
        minorGridLineColor: "#505053",
        tickColor: "#707073",
        tickWidth: 1,
        title: { style: { color: "#A0A0A3" } }
    },
    tooltip: {
        backgroundColor: "rgba(0, 0, 0, 0.85)",
        style: { color: "#F0F0F0" }
    },
    plotOptions: {
        series: {
            dataLabels: { color: "#F0F0F3", style: { fontSize: "13px" } },
            marker: { lineColor: "#333" }
        },
        boxplot: { fillColor: "#505053" },
        candlestick: { lineColor: "white" },
        errorbar: { color: "white" }
    },
    legend: {
        backgroundColor: "rgba(0, 0, 0, 0.5)",
        itemStyle: { color: "#E0E0E3" },
        itemHoverStyle: { color: "#FFF" },
        itemHiddenStyle: { color: "#606063" },
        title: { style: { color: "#C0C0C0" } }
    },
    credits: { style: { color: "#666" } },
    drilldown: {
        activeAxisLabelStyle: { color: "#F0F0F3" },
        activeDataLabelStyle: { color: "#F0F0F3" }
    },
    navigation: {
        buttonOptions: {
            symbolStroke: "#DDDDDD",
            theme: { fill: "#505053" }
        }
    },
    rangeSelector: {
        buttonTheme: {
            fill: "#505053",
            stroke: "#000000",
            style: { color: "#CCC" },
            states: {
                hover: {
                    fill: "#707073",
                    stroke: "#000000",
                    style: { color: "white" }
                },
                select: {
                    fill: "#000003",
                    stroke: "#000000",
                    style: { color: "white" }
                }
            }
        },
        inputBoxBorderColor: "#505053",
        inputStyle: { backgroundColor: "#333", color: "silver" },
        labelStyle: { color: "silver" }
    },
    navigator: {
        handles: { backgroundColor: "#666", borderColor: "#AAA" },
        outlineColor: "#CCC",
        maskFill: "rgba(255,255,255,0.1)",
        series: { color: "#7798BF", lineColor: "#A6C7ED" },
        xAxis: { gridLineColor: "#505053" }
    },
    scrollbar: {
        barBackgroundColor: "#808083",
        barBorderColor: "#808083",
        buttonArrowColor: "#CCC",
        buttonBackgroundColor: "#606063",
        buttonBorderColor: "#606063",
        rifleColor: "#FFF",
        trackBackgroundColor: "#404043",
        trackBorderColor: "#404043"
    }
};

var lightUnicaTheme = {
    colors: [
        "#7cb5ec",
        "#434348",
        "#90ed7d",
        "#f7a35c",
        "#8085e9",
        "#f15c80",
        "#e4d354",
        "#2b908f",
        "#f45b5b",
        "#91e8e1",
        "#e4b300"
    ],
    chart: {
        backgroundColor: "#ffffff",
        style: { fontFamily: "'Unica One', sans-serif" },
        plotBorderColor: "#e0e0e0"
    },
    title: {
        style: {
            color: "#333333",
            textTransform: "uppercase",
            fontSize: "20px"
        }
    },
    subtitle: {
        style: { color: "#333333", textTransform: "uppercase" }
    },
    xAxis: {
        gridLineColor: "#e0e0e0",
        labels: { style: { color: "#333333" } },
        lineColor: "#e0e0e0",
        minorGridLineColor: "#f0f0f0",
        tickColor: "#e0e0e0",
        title: { style: { color: "#333333" } }
    },
    yAxis: {
        gridLineColor: "#e0e0e0",
        labels: { style: { color: "#333333" } },
        lineColor: "#e0e0e0",
        minorGridLineColor: "#f0f0f0",
        tickColor: "#e0e0e0",
        tickWidth: 1,
        title: { style: { color: "#333333" } }
    },
    tooltip: {
        backgroundColor: "#ffffff",
        style: { color: "#333333" }
    },
    plotOptions: {
        series: {
            dataLabels: { color: "#333333", style: { fontSize: "13px" } },
            marker: { lineColor: "#333333" }
        },
        boxplot: { fillColor: "#f0f0f0" },
        candlestick: { lineColor: "#333333" },
        errorbar: { color: "#333333" }
    },
    legend: {
        backgroundColor: "rgba(255, 255, 255, 0.6)",
        itemStyle: { color: "#333333" },
        itemHoverStyle: { color: "#000000" },
        itemHiddenStyle: { color: "#c0c0c0" },
        title: { style: { color: "#333333" } }
    },
    credits: { style: { color: "#333333" } },
    drilldown: {
        activeAxisLabelStyle: { color: "#333333" },
        activeDataLabelStyle: { color: "#333333" }
    },
    navigation: {
        buttonOptions: {
            symbolStroke: "#333333",
            theme: { fill: "#ffffff" }
        }
    },
    rangeSelector: {
        buttonTheme: {
            fill: "#ffffff",
            stroke: "#e0e0e0",
            style: { color: "#333333" },
            states: {
                hover: {
                    fill: "#f0f0f0",
                    stroke: "#e0e0e0",
                    style: { color: "#000000" }
                },
                select: {
                    fill: "#e0e0e0",
                    stroke: "#e0e0e0",
                    style: { color: "#000000" }
                }
            }
        },
        inputBoxBorderColor: "#e0e0e0",
        inputStyle: { backgroundColor: "#ffffff", color: "#333333" },
        labelStyle: { color: "#333333" }
    },
    navigator: {
        handles: { backgroundColor: "#e0e0e0", borderColor: "#cccccc" },
        outlineColor: "#cccccc",
        maskFill: "rgba(255,255,255,0.1)",
        series: { color: "#7cb5ec", lineColor: "#7cb5ec" },
        xAxis: { gridLineColor: "#e0e0e0" }
    },
    scrollbar: {
        barBackgroundColor: "#e0e0e0",
        barBorderColor: "#e0e0e0",
        buttonArrowColor: "#333333",
        buttonBackgroundColor: "#ffffff",
        buttonBorderColor: "#e0e0e0",
        rifleColor: "#333333",
        trackBackgroundColor: "#f0f0f0",
        trackBorderColor: "#f0f0f0"
    }
};