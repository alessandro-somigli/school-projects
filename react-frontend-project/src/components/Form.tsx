import { useState } from "react"
import axios from "axios"

import "../style/FormStyle.scss"

type FormProps = {
    handleAdd: () => void
}

const Form = (props: FormProps): JSX.Element => {
    const [visible, setVisible] = useState(false)
    const [error, setError] = useState("")
    const [formData, setFormData] = useState({
        firstName: "",
        lastName: "",
        gender: "M",
        birthDate: "",
        hireDate: ""
    })

    const updateData = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value
        })
    }

    const onHandleClick = (visible: boolean, event: React.MouseEvent) => {
        setVisible(visible)
        event.preventDefault()
    }

    const onHandleSubmit = async (event: React.MouseEvent) => {
        let iscomplete = true

        console.log(formData)

        for (const k in formData) {
            const key = k as keyof typeof formData
            (formData[key]==='')?iscomplete=false:null
        }

        if (!iscomplete) { 
            event.preventDefault()
            setError("Errore: completa il form")
        } else { 
            setError("")
            onHandleClick(false, event)

            // ID doesn't really seem to be useful since the server assigns new IDs incrementally anyways,
            // but it is still required so I set it to -1
            await axios.post("http://localhost:8080/employees", {...formData, id: -1})
            props.handleAdd()
        }
    }

    return (
    <div className="employee-form">
        <button className="open" onClick={(event) => onHandleClick(true, event)}>Aggiungi</button>

        <form className={visible? "visible":""}>
            <div>
                <span className="button-close" onClick={(event) => onHandleClick(false, event)}>X</span>

                <label htmlFor="firstName">nome</label><br />
                <input onChange={e => updateData(e)} name="firstName" type="text" /><br />

                <label htmlFor="lastName">cognome</label><br />
                <input onChange={e => updateData(e)} name="lastName" type="text" /><br />

                <label htmlFor="gender">genere</label><br />
                <select onChange={e => updateData(e)} name="gender" id="">
                    <option value="M">M</option>
                    <option value="F">F</option>
                </select><br />

                <label htmlFor="birthDate">data di nascita</label><br />
                <input onChange={e => updateData(e)} name="birthDate" type="date" /><br />

                <label htmlFor="hireDate">data di impiegamento</label><br />
                <input onChange={e => updateData(e)} name="hireDate" type="date" /><br />

                <input className="form-input" type="submit" value="Conferma" onClick={(event) => onHandleSubmit(event)} /><br />

                <span className="form-error">{error}</span>
            </div>
        </form>
    </div>)
}

export { Form }