import { FC } from "react";
import { Button, ButtonProps } from "antd";
import { IconType } from "react-icons";

interface Props extends ButtonProps {
    width?: number;
    label: string;
    buttonIcon?: IconType;
    processing?: boolean;
}

const FormButton: FC<Props> = (props) => {
    const { htmlType, width, label, processing } = props;

    const buttonWidth = width ? `!w-[${width}px]` : "!w-[300px]";
    return (
        <Button
            htmlType={htmlType || "button"}
            loading={processing}
            className={`h-[40px] ${buttonWidth} bg-green-700 text-white text-base hover:!text-white `}
        >
            {label}
        </Button>
    );
};

export default FormButton;
