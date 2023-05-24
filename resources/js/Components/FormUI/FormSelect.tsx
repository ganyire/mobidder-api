import { FC, ReactNode } from "react";
import { Select, SelectProps, Tooltip } from "antd";
import { IconType } from "react-icons";

interface Props extends SelectProps {
    instructions: string;
    error?: string | null;
    icon?: IconType;
    width?: number;
    options: { label: string; value: string }[];
    name: string;
    helperText?: ReactNode;
}

const FormSelect: FC<Props> = (props) => {
    const {
        instructions,
        onChange,
        placeholder,
        error,
        icon: Icon,
        width,
        options,
        name,
        maxLength,
        helperText,
        value,
        ...rest
    } = props;

    const fieldWidth = width ? `w-[${width}px]` : "w-[300px]";

    return (
        <div>
            <Tooltip trigger={["focus"]} placement="left" title={instructions}>
                <Select
                    showSearch
                    allowClear
                    maxLength={maxLength || 80}
                    optionFilterProp="label"
                    status={error ? "error" : ""}
                    onChange={onChange}
                    placeholder={placeholder}
                    options={options}
                    className={`${fieldWidth} rounded-lg border-gray-300 flex items-center`}
                    size="large"
                    value={value}
                    {...rest}
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

export default FormSelect;
