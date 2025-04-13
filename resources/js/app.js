import * as bootstrap from 'bootstrap';
class Lotto {
    saveBtn = document.querySelector("#save-ticket");
    selectedNumbers = [];
    hiddenNumberInput=document.querySelector("#numbers")
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
        this.createEventListenerToSaveButton()
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
        for (const number of numbers) {
            number.addEventListener("click", ()=>{
                this.clickOnNumber(number)
            });
        }
    }
    createEventListenerToSaveButton(){
        this.saveBtn.addEventListener("click", this.submitForm);
    }
    clickOnNumber(number){
        const num = number.textContent;
        if (this.selectedNumbers.includes(num)) {
            number.classList.remove("selected");
            this.selectedNumbers.splice(this.selectedNumbers.indexOf(num), 1);
        } else {
            if (this.selectedNumbers.length < 5) {
                this.selectedNumbers.push(num);
                number.classList.add("selected");
            }
        }
        this.selectedNumbers.sort((a, b) => a - b);
        this.hiddenNumberInput.value = this.selectedNumbers.join(", ");
        if (this.selectedNumbers.length === 5) {
            this.saveBtn.disabled = false;
        } else {
            this.saveBtn.disabled = true;
        }
    }
    
    submitForm(){
        document.querySelector("#save-ticket").disabled = true;
        document.getElementById("ticket-form").submit()
    }
}

const lotto = new Lotto();
window.lotto = lotto;
window.submitForm = lotto.submitForm.bind(lotto);

