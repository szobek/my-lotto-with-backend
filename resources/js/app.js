class Lotto {
    constructor() {
        this.createDashboardFromNums()
        if (document.querySelector("#number-wrapper")) {
            for (let i = 1; i <= 90; i++) {
                const number = document.createElement("div");
                number.classList.add("number");
                number.textContent = i;
                const wrapper = document.querySelector("#number-wrapper");
                wrapper.appendChild(number);
            }
        this.creatEventListenerToNumbers()
        }
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
        if (wrapper) {
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
    creatEventListenerToNumbers() {
        const numbers = document.querySelectorAll(".number");
        const selectedNumbers = [];
        for (const number of numbers) {
            number.addEventListener("click", () => {
                const num = number.textContent;
                if (selectedNumbers.includes(num)) {
                    number.classList.remove("selected");
                    selectedNumbers.splice(selectedNumbers.indexOf(num), 1);
                } else {
                    if (selectedNumbers.length < 5) {
                        selectedNumbers.push(num);
                        number.classList.add("selected");
                    }
                }
                selectedNumbers.sort((a, b) => a - b);
            });
        }
    }
}

const lotto = new Lotto();
window.lotto = lotto;
