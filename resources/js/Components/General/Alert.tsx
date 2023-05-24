import { FC, ReactNode } from "react";
import { Alert as AntAlert, AlertProps } from "antd";
import { BsExclamation, BsCheck } from "react-icons/bs";

interface Props extends AlertProps {}

const Alert: FC<Props> = (props) => {
    const { message, type } = props;

    let icon: ReactNode;
    let color: string = "";

    if (type === "error") {
        icon = <BsExclamation size={30} />;
        color = "text-red-700";
    } else if (type === "success") {
        icon = <BsCheck size={30} />;
        color = "text-green-900";
    }

    return (
        <AntAlert
            message={message}
            type={type}
            showIcon
            icon={icon}
            banner
            className={`font-interItalic text-base ${color} `}
        />
    );
};

export default Alert;
