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

$.ajax({
  url: "php/workedHours.php",
  type: "GET",
  success: function (result) {
    const response = JSON.parse(result);
    totalWorkedHours.innerHTML = response.totalWorkedHours;
    const temTargetSales = response.totalWorkedHours * 90;
    targetSales.innerHTML = `${temTargetSales}€`;
    productivityRate.innerHTML = response.productivityRate;
    profit.innerHTML = `${response.profit}€`;
    response.loss === 0
      ? (loss.innerHTML = `${response.loss}€`)
      : (loss.innerHTML = `-${response.loss}€`);
    response.salesTotal !== "unlimited"
      ? (salesTotal.innerHTML = `${response.salesTotal}€`)
      : (salesTotal.innerHTML = `${response.salesTotal}`);

    var clientTableData = "";
    Object.values(response.client).forEach((element) => {
      const profitShare = element.budgetHours * 100;
      const timeShare = element.timeShare * 100;
      const amount = element.workedHours * 90;
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
         ${timeShare}(${element.workedHours} hours)
        </td>
        <td class="text-center">
         ${amount}€
        </td>
      </tr>`;
    });
    clientTable.innerHTML = clientTableData;
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
    const colors = [" #6896f9", "#85c751", "#806ef9", "#d97b70"];
    Object.values(response.newClientProjects).forEach((element) => {
      if (count % 2 !== 0) {
        allProjectData += `
        <div class="col-auto col-xxxxl-6 ml-sm-auto mr-sm-auto">
          <div class="legend-value-w">
            <div class="legend-pin legend-pin-squared" style="background-color: ${colors[count%4]};"></div>
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
            <div class="legend-pin legend-pin-squared" style="background-color: ${colors[count%4]};"></div>
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

    noOfProjects.innerHTML = projectsData;
    individualprojectsData.innerHTML = allProjectData;
  },
});
