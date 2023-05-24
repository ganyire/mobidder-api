import { FC, ReactNode } from "react";
import { Input, InputProps, Tooltip } from "antd";
import { IconType } from "react-icons";

interface Props extends InputProps {
    instructions: string;
    error?: string | null;
    icon?: IconType;
    width?: number;
    name: string;
    helperText?: ReactNode;
}

const FormInput: FC<Props> = (props) => {
    const {
        instructions,
        type,
        onChange,
        error,
        icon: Icon,
        width,
        name,
        placeholder,
        maxLength,
        value,
        helperText,
        ...rest
    } = props;

    const fieldWidth = width ? `w-[${width}px]` : "w-[300px]";

    return (
        <div>
            <Tooltip trigger={["focus"]} placement="left" title={instructions}>
                {(function () {
                    if (type === "password") {
                        return (
                            <Input.Password
                                type={type || "text"}
                                name={name}
                                status={error ? "error" : ""}
                                showCount
                                maxLength={maxLength || 80}
                                onChange={onChange}
                                placeholder={placeholder}
                                prefix={
                                    Icon ? (
                                        <Icon
                                            className="text-gray-400"
                                            size={25}
                                        />
                                    ) : null
                                }
                                value={value}
                                className={`${fieldWidth} rounded-lg border-gray-300 h-[40px] focus:!ring-gray-200 `}
                                {...rest}
                            />
                        );
                    }

                    return (
                        <Input
                            type={type || "text"}
                            name={name}
                            status={error ? "error" : ""}
                            showCount
                            maxLength={maxLength || 80}
                            onChange={onChange}
                            placeholder={placeholder}
                            prefix={
                                Icon ? (
                                    <Icon className="text-gray-400" size={25} />
                                ) : null
                            }
                            value={value}
                            className={`${fieldWidth} rounded-lg border-gray-300 h-[40px] focus:!ring-gray-200 `}
                            {...rest}
                        />
                    );
                })()}
            </Tooltip>

            {error && <p className="text-red-700 text-sm">{error}</p>}

            {helperText && (
                <div className="text-xs flex flex-col text-gray-600 mt-1 px-2 ">
                    {helperText}
                </div>
            )}
        </div>
    );
};

export default FormInput;
