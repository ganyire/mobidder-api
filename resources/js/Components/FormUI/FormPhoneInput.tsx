import "react-phone-number-input/style.css";
import PhoneInput from "react-phone-number-input";
import { Tooltip } from "antd";
import { FC, ReactNode } from "react";

interface Props {
    instructions: string;
    error?: string | null;
    width?: number;
    name: string;
    placeholder: string;
    value?: string;
    helperText?: ReactNode;
    onChange: (e: string) => void;
}

const FormPhoneInput: FC<Props> = (props) => {
    const {
        instructions,
        error,
        width,
        name,
        value,
        placeholder,
        helperText,
        onChange,
    } = props;

    const fieldWidth = width ? `w-[${width}px]` : "w-[300px]";

    return (
        <div>
            <Tooltip trigger={["focus"]} placement="left" title={instructions}>
                <PhoneInput
                    placeholder={placeholder}
                    name={name}
                    value={value}
                    onChange={onChange}
                    smartCaret
                    international
                    className={`${fieldWidth} bg-white rounded-lg border px-2 border-gray-300 h-[40px] [&>input]:border-0 [&>input]:text-sm [&>input]:py-1 [&>input:focus]:ring-0 `}
                />
            </Tooltip>

            {error && <p className="text-red-700 text-sm">{error}</p>}

            {value && helperText && (
                <p className="text-xs flex flex-col text-gray-600 mt-1 px-2 ">
                    {helperText}
                </p>
            )}
        </div>
    );
};

export default FormPhoneInput;
