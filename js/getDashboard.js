const totalWorkedHours = document.getElementById("totalWorkedHours");
const targetSales = document.getElementById("targetSales");
const productivityRate = document.getElementById("productivityRate");
const profit = document.getElementById("profit");
const loss = document.getElementById("loss");
const salesTotal = document.getElementById("salesTotal");
const employeeTable = document.getElementById("employeeTable");
const clientTable = document.getElementById("clientTable");
const noOfProjects = document.getElementById("noOfProjects");
const individualprojectsData = document.getElementById("projectsData");
const dashBoardLoader = document.getElementById("dashBoardLoader");
const employeeLoader = document.getElementById("employeeLoader");
const clientLoader = document.getElementById("clientLoader");
const projectsLoader = document.getElementById("projectsLoader");
const projectForecast = document.getElementById("projectForecast");
const forecastLoader = document.getElementById("forecastLoader");
const jobHours = document.getElementById("jobHours");
const occupiedEmployees = document.getElementById("occupiedEmployees");


$.ajax({
  url: "php/workedHours.php",
  type: "GET",
  success: function (result) {
    const response = JSON.parse(result);
    totalWorkedHours.innerHTML = `<span style="font-weight: bold;"> ${response.totalWorkedHours}H </span>`;
    targetSales.innerHTML = `<span style="font-weight: bold;">${response.targetSales}€ </span>`;
    productivityRate.innerHTML = `<span style="font-weight: bold;">${response.productivityRate} </span>`;
    profit.innerHTML = `<span style="font-weight: bold;">${response.profit}€ </span>`;
    response.loss === 0
      ? (loss.innerHTML = `<span style="font-weight: bold;">${response.loss}€</span>`)
      : (loss.innerHTML = `<span style="font-weight: bold;"> -${response.loss}€</span>`);
    response.salesTotal !== "unlimited"
      ? (salesTotal.innerHTML = `<span style="font-weight: bold;">${response.salesTotal}€</span>`)
      : (salesTotal.innerHTML = `<span style="font-weight: bold;">${response.salesTotal}</span>`);

    var clientTableData = "";
    Object.values(response.client).forEach((element) => {
      const profitShare = element.budgetHours * 100;
      const timeShare = element.timeShare * 100;
      const amount = element.workedHours * 90;

      console.log("response.forecast", response.forecast);
      if (response.forecast > 0) {
        projectForecast.innerHTML = `<span style="font-weight: bold;"> +${response.forecast}  </span>`;
      } else if (response.forecast < 0) {
        projectForecast.innerHTML = `<span style="font-weight: bold;"> -${response.forecast}  </span>`;
      } else {
        projectForecast.innerHTML = `<span style="font-weight: bold;"> ${response.forecast} </span>`;
      }

      clientTableData += `
      <tr>
        <td></td>
        <td >
          ${element.name}
        </td>
        <td class="text-center">
          ${element.numOfProjects} 
        </td>
        <td class="text-center">
          ${profitShare}%
        </td>
        <td class="text-center">
         ${timeShare}% (${element.workedHours} hours)
        </td>
        <td class="text-center">
         ${amount}€
        </td>
      </tr>`;
    });
    clientTable.innerHTML = clientTableData;
    jobHours.innerHTML = `<span style="font-weight: bold;"> ${response.jobHours}h </span>`;
    occupiedEmployees.innerHTML = `<span style="font-weight: bold;"> ${response.fullyOccupiedEmployees} </span>`;

    dashBoardLoader.style.visibility = "hidden";
    clientLoader.style.visibility = "hidden";
    forecastLoader.style.visibility = "hidden";
  },
});

$.ajax({
  url: "php/users.php",
  type: "GET",
  success: function (result) {
    const response = JSON.parse(result);

    var employeeTableData = "";
    Object.values(response.users).forEach((element) => {
      employeeTableData += `
      <tr>
        <td >
          ${element.name}
        </td>
        <td >
          ${element.workedHours}
        </td>
        <td >
          ${element.productivityRate}
        </td>
      </tr>`;
    });
    employeeTable.innerHTML = employeeTableData;
    employeeLoader.style.visibility = "hidden";
  },
});

$.ajax({
  url: "php/projects.php",
  type: "GET",
  success: function (result) {
    const response = JSON.parse(result);

    const projectsData = `<strong>${response.totalProjects}</strong><span>Projects</span>`;
    var allProjectData = "";
    var count = 1;
    const colorsArray = [];
    const companyNamesArray = [];
    const projectsCountArray = [];
    Object.values(response.newClientProjects).forEach((element) => {
      const bgColor = "#" + (((1 << 24) * Math.random()) | 0).toString(16);
      colorsArray.push(bgColor);
      companyNamesArray.push(element.name);
      projectsCountArray.push(element.newProjects);
      if (count % 2 !== 0) {
        allProjectData += `
        <div class="col-auto col-xxxxl-6 ml-sm-auto mr-sm-auto">
          <div class="legend-value-w">
            <div class="legend-pin legend-pin-squared" style="background-color: ${bgColor};"></div>
              <div class="legend-value">
                <span>${element.name}</span>
                <div class="legend-sub-value">
                  ${element.newProjects}
                </div>
            </div>
          </div>`;
        count += 1;
      } else {
        allProjectData += `
          <div class="legend-value-w">
            <div class="legend-pin legend-pin-squared" style="background-color: ${bgColor};"></div>
              <div class="legend-value">
                <span>${element.name}</span>
                <div class="legend-sub-value">
                  ${element.newProjects}
                </div>
            </div>
          </div>
        </div>`;
        count += 1;
      }
    });

    if ($("#donutChart123").length) {
      var donutChart1 = $("#donutChart123");

      // donut chart data
      var data1 = {
        labels: companyNamesArray,
        datasets: [
          {
            data: projectsCountArray,
            backgroundColor: colorsArray,
            hoverBackgroundColor: colorsArray,
            borderWidth: 6,
            hoverBorderColor: "transparent",
          },
        ],
      };

      // -----------------
      // init donut chart
      // -----------------
      new Chart(donutChart1, {
        type: "doughnut",
        data: data1,
        options: {
          legend: {
            display: false,
          },
          animation: {
            animateScale: true,
          },
          cutoutPercentage: 80,
        },
      });
    }

    noOfProjects.innerHTML = projectsData;
    individualprojectsData.innerHTML = allProjectData;
    projectsLoader.style.visibility = "hidden";
  },
});
