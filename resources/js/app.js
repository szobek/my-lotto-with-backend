import './bootstrap';
class Lotto {
    lastNumbers;
    numbers
    constructor() {
        this.lastNumbers = {};
        this.numbers = [];
        this.createEventListeners()
        this.loadLastNumbersFromLocalStorage()
        this.createDashboardFromNums()
    }
    generateNumbers() {
        this.numbers = [];
        while (this.numbers.length < 5) {
            let randomNumber = Math.floor(Math.random() * 90) + 1;
            if (!this.numbers.includes(randomNumber)) {
                this.numbers.push(randomNumber);
            }
        }
        this.numbers.sort((a, b) => a - b);
        this.createBalls()
        this.writeNumsToDashboard()
    }
    getNumbers() {
        return this.numbers;
    }


    createBalls() {
        const wrapper = document.querySelector("#wrapper")
        wrapper.innerHTML = "";
        const row = document.createElement("div");
        row.classList.add("ball-row");
        wrapper.appendChild(row);
        for (let ball of this.numbers) {
            const ballElement = document.createElement("div");
            ballElement.classList.add("ball");
            const text = document.createElement("span");
            text.textContent = ball;
            ballElement.appendChild(text);
            row.appendChild(ballElement);
        }
    }
    createEventListeners() {
        document.getElementById("sorsolo-btn")
            .addEventListener("click", () => {
                sorsol()
            });
    }

    writeNumsToDashboard() {

        this.numbers.forEach((num) => {
            if (this.lastNumbers[num]) {
                this.lastNumbers[num]++;
            } else {
                this.lastNumbers[num] = 1;
            }
        })
        this.createDashboardFromNums()
    }

    createDashboardFromNums() {
        const wrapper = document.getElementById("dashboard")
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
        for (const num in this.lastNumbers) {
            const row = document.createElement("tr");
            const cell = document.createElement("td");
            const cell2 = document.createElement("td");
            cell.textContent = num;
            cell2.textContent = this.lastNumbers[num];
            row.appendChild(cell);
            row.appendChild(cell2);
            rows.push(row);
        }

        tbody.append(...rows);
        this.saveLastNumbersToLocalStorage()
    }

    saveLastNumbersToLocalStorage() {
        localStorage.setItem("lastNumbers", JSON.stringify(this.lastNumbers));
    }

    loadLastNumbersFromLocalStorage() {
        const savedLastNumbers = localStorage.getItem("lastNumbers");
        if (savedLastNumbers) {
            this.lastNumbers = JSON.parse(savedLastNumbers);
        }
    }


}

const lotto = new Lotto();
const sorsol = () => {
    lotto.generateNumbers();
}