const totalWorkedHours = document.getElementById("totalWorkedHours");
const targetSales = document.getElementById("targetSales");
const productivityRate = document.getElementById("productivityRate");
const profit = document.getElementById("profit");
const loss = document.getElementById("loss");
const salesTotal = document.getElementById("salesTotal");
const employeeTable = document.getElementById("employeeTable");

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
  },
});

$.ajax({
  url: "php/users.php",
  type: "GET",
  success: function (result) {
    const response = JSON.parse(result);

    console.log(response);

    var employeeTableData = "";

    for (user in response.users) {
      console.log(user, user.name);

      // employeeTableData += `
      // <tr>
      //   <td class="text-center">
      //     ${name}
      //   </td>
      //   <td class="text-center">
      //     ${workedHours}
      //   </td>
      //   <td class="text-center">
      //     not yet calculated
      //   </td>
      // </tr>`;
    }
    employeeTable.innerHTML = employeeTableData;
  },
});
