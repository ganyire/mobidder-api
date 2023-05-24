import { FormButton, FormInput } from "@/Components/FormUI";
import { useForm, usePage } from "@inertiajs/react";
import { Button, Modal } from "antd";
import { FormEventHandler, useState } from "react";
import { BsShieldExclamation } from "react-icons/bs";
import { TfiEmail } from "react-icons/tfi";
import clsx from "clsx";
import { PageProps } from "@/types";

type FormValues = {
    email: string;
    password: string;
};

const ChangeEmailAddress = () => {
    const { auth } = usePage<PageProps>().props;

    const [showForm, setShowForm] = useState(false);

    const openForm = () => {
        setShowForm(true);
    };

    const closeForm = () => {
        setShowForm(false);
    };

    const [showWarning, setShowWarning] = useState(false);

    const openWarningMessage = () => {
        setShowWarning(true);
    };

    const closeWarningMessage = () => {
        setShowWarning(false);
    };

    const onAgreeingWithWarningMessage = () => {
        closeWarningMessage();
        openForm();
    };

    const formValues: FormValues = {
        email: "",
        password: "",
    };

    const { data, processing, post, errors, setData } = useForm(formValues);

    const onSubmit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route("action.change-email-address"));
        closeForm();
    };

    return (
        <form onSubmit={onSubmit} className="w-[400px]">
            <div className="space-y-1 mb-2 pb-2 ">
                <p>Change email address</p>
                <p className="text-xs ">
                    Changing email address means a change in your login
                    credentials, and can have unintended effects
                </p>
            </div>

            {!showForm && (
                <Button htmlType="button" onClick={openWarningMessage}>
                    Change email address
                </Button>
            )}

            {showForm && (
                <div className="mt-4 space-y-3">
                    <p>
                        Your current email is{" "}
                        <span>{auth?.attributes?.email}</span>
                    </p>
                    <FormInput
                        name="email"
                        instructions="New email address *"
                        placeholder="Enter new email address"
                        icon={TfiEmail}
                        value={data.email}
                        error={errors.email}
                        width={400}
                        helperText="Your email address is your login credentials"
                        onChange={(e) => {
                            setData("email", e.target.value);
                        }}
                    />

                    <FormButton
                        label="Change my email address"
                        htmlType="submit"
                        width={200}
                        processing={processing}
                    />
                </div>
            )}

            <Modal
                className=" font-inter"
                title="Do you really want to change your email address?"
                open={showWarning}
                onOk={onAgreeingWithWarningMessage}
                onCancel={closeWarningMessage}
                footer={null}
            >
                <p
                    className={clsx([
                        "p-4",
                        "flex items-center gap-3",
                        "bg-yellow-50",
                        "border-y border-gray-200 ",
                    ])}
                >
                    <BsShieldExclamation
                        size={25}
                        className="text-secondary-alternative"
                    />{" "}
                    Unexpected bad things may happen if you don't read this!
                </p>

                <ul className=" list-inside list-disc my-4 ">
                    <li className="list-item">
                        Your login credentials will change to the new email
                    </li>
                    <li className="list-item">
                        Notifications will now be sent to the new email address
                    </li>
                    <li className="list-item">
                        Your will need to verify the new email address to be
                        able to use certain parts of the system
                    </li>
                </ul>

                <Button
                    htmlType="button"
                    className={clsx([
                        "w-full",
                        "h-[40px]",
                        "text-red-600 hover:!text-white",
                        "hover:bg-red-600",
                    ])}
                    onClick={onAgreeingWithWarningMessage}
                >
                    I understand, let's change my email address
                </Button>
            </Modal>
        </form>
    );
};

export default ChangeEmailAddress;
