import axios from 'axios'

type TableProps = {
    employees: Array<Employee>
    handleDelete: () => void
}

type Employee = {
    id: number
    firstName: string
    lastName: string
    gender: string
    birthDate: string
    hireDate: string
}

import "../style/TableStyle.scss"

const Table = (props: TableProps): JSX.Element => {

    const onHandleDelete = async (id: number) => {
        await axios.delete('http://localhost:8080/employees/' + id)
        props.handleDelete()
    }

    return (
        <div className="table-container">
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>nome</th>
                        <th>cognome</th>
                        <th>genere</th>
                        <th>data di nascita</th>
                        <th>data di impiegamento</th>
                        <th>azioni</th>
                    </tr>
                </thead>
                <tbody>
                    {props.employees.map((employee: Employee) => 
                    <tr key={employee.id}>
                        <td>{employee.id}</td>
                        <td>{employee.firstName}</td>
                        <td>{employee.lastName}</td>
                        <td>{employee.gender}</td>
                        <td>{employee.birthDate}</td>
                        <td>{employee.hireDate}</td>
                        <td><button onClick={() => onHandleDelete(employee.id)}>Elimina</button></td>
                    </tr>)}
                </tbody>
            </table>
        </div>
    )
}

export { Table }