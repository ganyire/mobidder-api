import { FC, ReactNode } from "react";

interface Props {
    children: ReactNode;
}

const AuthLayout: FC<Props> = (props) => {
    const { children } = props;

    return (
        <main className="grid grid-cols-12 min-h-screen bg-slate-800 bg-[url(/images/online-shopping.png)] bg-center bg-[length:900px_900px] bg-no-repeat ">
            <div className="col-span-7 flex justify-center items-center relative">
                <section className="absolute h-32 w-32 -right-[270px] top-[40px] rounded-full bg-white"></section>
                <section className="absolute h-32 w-32 -right-[90px] top-[250px] rounded-full bg-white"></section>
            </div>

            <div className="col-span-5 bg-white flex flex-col justify-center items-center gap-4 pl-[20%] pr-[100px] rounded-l-full relative">
                <section className="absolute h-32 w-32 -left-[20px] top-[133px] rounded-full bg-slate-800"></section>
                <section className="absolute h-32 w-32 right-0 top-0 rounded-l-full rounded-br-full bg-slate-800"></section>

                {children}
            </div>
        </main>
    );
};

export default AuthLayout;
