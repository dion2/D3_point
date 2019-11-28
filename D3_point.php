<!DOCTYPE html>
<meta charset="utf-8">
<title>Line</title>

<body>
    <div id="D3_Line"></div>
    <!-- <script src="https://d3js.org/d3.v3.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../D3/d3.min.js"></script>


    <script>
        data = [{
            "date": "20191120",
            "type": "統計循環",
            "value": 40,
            "color": "#000079"
        }, {
            "date": "20191120",
            "type": "作業循環",
            "value": 30,
            "color": "#000079"
        }, {
            "date": "2019-03-01",
            "type": "整體循環",
            "value": 30,
            "color": "#467500"
        }, {
            "date": "2019-03-01",
            "type": "作業循環",
            "value": 30,
            "color": "#000079"
        }];
        data_text = [{
            "type": "統計循環",
            "color": "#000079"
        }, {
            "type": "作業循環",
            "color": "#000079"
        }, {
            "type": "整體循環",
            "color": "#467500"
        }]


        width = "800";
        height = "600";
        padding = "200";
        var svg = d3.select('#D3_Line')
            .append('svg')
            .attr('width', width)
            .attr('height', height)
            .data(data);


        var x = d3.scaleBand()
            .domain($.map(data, function(item, index) {
                return item.date;
            }))
            .rangeRound([100, width - padding])
            .padding(0.4);

        // var y = d3.scaleLinear()
        //     .domain(["A","B","C"])
        //     .rangeRound([height-50, 0]);
        var y = d3.scaleBand()
            .domain($.map(data, function(item, index) {
                return item.type;
            }))
            .rangeRound([height - 50, 0]);

        // Draw the axis
        svg.append("g")
            .attr("transform", "translate(15," + (height - 50) + ")") // This controls the vertical position of the Axis
            .call(d3.axisBottom(x))
            .selectAll("text")
            .attr("style", "font-size:15px")
            .attr("transform", "translate(-10,15)rotate(45)")
            .attr({
                'fill': 'none',
                'stroke': 'rgba(0,0,0,.1)',
                'transform': 'translate(35,' + (height + 20) + ')'
            });

        svg.append("g")
            .attr("transform", "translate(115,0)") // This controls the vertical position of the Axis
            .call(d3.axisLeft(y))
            .selectAll("text")
            .attr("style", "font-size:15px");

        // Add one bar for group C:
        // svg
        // svg.append("rect")
        //     .attr("x", x("2019-01-01"))
        //     .attr("y", 0)
        //     .attr("height", height - 50)
        //     .attr("width", x.bandwidth())
        //     .style("fill", "#69b3a2")
        //     .style("opacity", 0.5)
        //     .attr("transform", "translate(15,0)")

        svg.selectAll("circle")
            .data(data)
            .enter()
            .append("circle")
            .attr("cx", function(d, i) {
                return x(d.date) + 52;
            })
            .attr("cy", function(d) {
                return height - (height - 48 - y(d.type));
                // return height - (height - 50 - y(d.type));
            })
            .attr("r", function(d) {
                return d.value
            })
            .attr("transform", function(d) {
                return "translate(25,45)"
            })
            .attr("fill", function(d) {
                return d.color;
            })

        svg.selectAll("circle_text")
            .data(data)
            .enter()
            .append("text")
            .attr("x", function(d, i) {
                return x(d.date) + 65;
            })
            .attr("y", function(d) {
                return height - (height - 95 - y(d.type));
            })
            .text(function(d) {
                return d.value
            })
            .attr("fill", "#FFFFFF")

        svg.selectAll("rect_tools")
            .data(data_text)
            .enter()
            .append("rect")
            .attr("x", width - 100)
            .attr("y", function(d, i) {
                return 3.5 + (i * 21)
            })
            .attr("dy", "0.25em")
            .attr("width", 15)
            .attr("height", 15)
            .attr("fill", function(d) {
                return d.color;
            });


        svg.selectAll("text2")
            .data(data_text)
            .enter()
            .append("text")
            .attr("x", width - 80)
            .attr("y", function(d, i) {
                return 9.5 + (i * 21)
            })
            .attr("dy", "0.35em")
            .text(function(d) {
                return d.type
            });
    </script>
</body>

</html>