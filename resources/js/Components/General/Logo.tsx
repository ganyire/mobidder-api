import clsx from "clsx";

const Logo = () => {
    return (
        <div
            className={clsx([
                "flex justify-center items-center",
                "bg-gradient-to-t from-slate-400 via-slate-100 to-slate-50",
                "rounded-full border border-slate-200",
                "p-2",
            ])}
        >
            <p
                className={clsx([
                    "text-2xl font-interBold",
                    "bg-clip-text text-transparent",
                    "bg-gradient-to-r from-secondary via-yellow-700 to-accent",
                ])}
            >
                MOBIDDER
            </p>
        </div>
    );
};

export default Logo;
