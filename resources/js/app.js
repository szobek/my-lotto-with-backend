import * as bootstrap from 'bootstrap';
class Lotto {
    constructor() {
        this.createDashboardFromNums()
    }

    createBalls(numbers) {
        const wrapper = document.querySelector("#wrapper")
        wrapper.innerHTML = "";
        const row = document.createElement("div");
        row.classList.add("ball-row");
        wrapper.appendChild(row);
        for (let ball of numbers) {
            const ballElement = document.createElement("div");
            ballElement.classList.add("ball");
            const text = document.createElement("span");
            text.textContent = ball;
            ballElement.appendChild(text);
            row.appendChild(ballElement);
        }
    }
   
    createDashboardFromNums(lastNumbers) {
        const wrapper = document.getElementById("dashboard")
        if (!wrapper) {
            console.error("Dashboard element not found");
            return;
        }
        
        wrapper.innerHTML = "";

        const table = document.createElement("table");
        const thead = document.createElement("thead");
        const tbody = document.createElement("tbody");

        table.appendChild(thead);
        table.appendChild(tbody);

        const headerRow = document.createElement("tr");
        const headerCell = document.createElement("th");
        const headerCell2 = document.createElement("th");
        headerCell.textContent = "Számok";
        headerCell2.textContent = "húzva";
        headerRow.appendChild(headerCell);
        headerRow.appendChild(headerCell2);
        thead.appendChild(headerRow);

        wrapper.appendChild(table);

        const rows = [];
        for (const num in lastNumbers) {
            const row = document.createElement("tr");
            const cell = document.createElement("td");
            const cell2 = document.createElement("td");
            cell.textContent = num;
            cell2.textContent = lastNumbers[num];
            row.appendChild(cell);
            row.appendChild(cell2);
            rows.push(row);
        }

        tbody.append(...rows);
    }

   


}

const lotto = new Lotto();
window.lotto = lotto;
const sorsol = () => {
    lotto.generateNumbers();
}