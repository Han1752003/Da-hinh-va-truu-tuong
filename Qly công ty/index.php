<?php
abstract class Employee {
    protected $name;
    protected $salary;

    public function __construct($name, $salary) {
        $this->name = $name;
        $this->salary = $salary;
    }

    abstract public function calculateBonus();

    public function getName() {
        return $this->name;
    }

    public function getSalary() {
        return $this->salary;
    }

    public function getJobTitle() {
        return static::class;
    }
}

interface Workable {
    public function work();
}

class Manager extends Employee implements Workable {
    public function calculateBonus() {
        return $this->salary * 0.2; 
    }

    public function work() {
        return "Manager";
    }
}

class Developer extends Employee implements Workable {
    public function calculateBonus() {
        return $this->salary * 0.1; 
    }

    public function work() {
        return "Developer";
    }
}

class Designer extends Employee implements Workable {
    public function calculateBonus() {
        return $this->salary * 0.15; 
    }

    public function work() {
        return "Designer";
    }
}

$employeeList = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['employee_name']);
    $salary = (float)$_POST['employee_salary'];
    $position = $_POST['employee_position'];

    switch ($position) {
        case 'manager':
            $employeeList[] = new Manager($name, $salary);
            break;
        case 'developer':
            $employeeList[] = new Developer($name, $salary);
            break;
        case 'designer':
            $employeeList[] = new Designer($name, $salary);
            break;
    }
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Nhân viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2, h3 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
        .employee-list {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <form method="POST" action="">
        <h2>Nhập thông tin nhân viên</h2>

        <label for="employee_position">Chọn vị trí:</label>
        <select name="employee_position" id="employee_position" required>
            <option value="">--Chọn vị trí--</option>
            <option value="manager">Manager</option>
            <option value="developer">Developer</option>
            <option value="designer">Designer</option>
        </select><br><br>

        <label for="employee_name">Tên:</label>
        <input type="text" name="employee_name" required><br><br>

        <label for="employee_salary">Lương:</label>
        <input type="number" name="employee_salary" required><br><br>

        <input type="submit" value="Tính thưởng">
    </form>

    <?php if (!empty($employeeList)): ?>
        <div class="employee-list">
            <h2>Danh sách nhân viên:</h2>
            <ul>
                <?php foreach ($employeeList as $employee): ?>
                    <li>
                        <?php
                            echo $employee->getName() . " - " . $employee->work() . 
                            " - Lương: " . number_format($employee->getSalary(), 2) . 
                            " VNĐ - Thưởng: " . number_format($employee->calculateBonus(), 2) . " VNĐ";
                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</body>
</html>