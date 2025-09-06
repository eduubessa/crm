import { Customer, type SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';
import { HomeIcon } from 'lucide-react';
import AppNavbar from '@/components/app-navbar';


export default function Welcome() {
    const { auth } = usePage<SharedData>().props;
    const { recent_customers, all_customers } = usePage<Customer>().props;

    return (
        <>
            <Head title="Dashboard">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="bg-gradient-main flex min-h-screen flex-col items-stretch">
                <AppNavbar />
                <main className="mx-auto w-full px-4 py-6">
                    <section id="app-counters" className="px-3 py-2">
                        <div className="flex items-center space-x-4">
                            <h1 className="mr-50 ml-4 w-50 text-3xl font-bold text-gray-800">Informações dos clientes</h1>
                            <div className="flex space-x-4 overflow-x-auto">
                                <div className="flex w-70 items-center space-x-2 rounded-lg px-4 py-2">
                                    <div className="mr-3 rounded-4xl bg-[rgba(150,150,150,0.2)] p-4 text-2xl">
                                        <HomeIcon size={16} />
                                    </div>
                                    <div>
                                        <div className="text-lg font-bold">$1,980,130</div>
                                        <div className="mt-1 text-xs text-gray-500">Total de clientes registados</div>
                                    </div>
                                </div>
                            </div>
                            <div className="flex space-x-4 overflow-x-auto">
                                <div className="flex w-70 items-center space-x-2 rounded-lg px-4 py-2">
                                    <div className="mr-3 rounded-4xl bg-[rgba(150,150,150,0.2)] p-4 text-2xl">
                                        <HomeIcon size={16} />
                                    </div>
                                    <div>
                                        <div className="text-lg font-bold">
                                            + 150
                                            <span className="ml-2 rounded-full bg-green-600 px-2 py-1 text-xs font-bold text-white">+5 mês</span>
                                        </div>
                                        <div className="mt-1 text-xs text-gray-500">Novos clientes por mês</div>
                                    </div>
                                </div>
                            </div>
                            <div className="overflow-x-auto] flex space-x-4">
                                <div className="flex w-70 items-center space-x-2 rounded-lg px-4 py-2">
                                    <div className="mr-3 rounded-4xl bg-[rgba(150,150,150,0.2)] p-4 text-2xl">
                                        <HomeIcon size={16} />
                                    </div>
                                    <div>
                                        <div className="text-lg font-bold">
                                            + 150
                                            <span className="ml-2 rounded-full bg-green-600 px-2 py-1 text-xs font-bold text-white">+5 mês</span>
                                        </div>
                                        <div className="mt-1 text-xs text-gray-500">Novos clientes por mês</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div className="flex gap-6 px-6 py-4">
                        <section className="w-2/3">
                            <div className="space-x-4 rounded-2xl rounded-4xl px-6 py-8 text-black shadow">
                                <header>
                                    <h2 className="text-md mb-2 font-semibold">Clientes recentes</h2>
                                </header>
                                <div className="flex items-stretch gap-4 overflow-x-auto">
                                    { recent_customers && recent_customers.map((customer, index) => (
                                            <article
                                                key={'xcust' + index}
                                                className="h-45 flex-1 items-center space-x-4 rounded-2xl bg-blue-300 px-3 py-4"
                                            >
                                                <h1 className="w-full text-lg font-bold">{customer.name}</h1>
                                                <p>{customer.email}</p>
                                                <p>{customer.mobile_phone}</p>
                                                <p>{customer.city}</p>
                                                <p>{customer.country}</p>
                                            </article>
                                        ))}
                                </div>
                            </div>

                            <div className="mt-5 space-x-4 rounded-2xl rounded-4xl px-6 py-8 text-black shadow">
                                <header>
                                    <h2 className="text-md mb-2 font-semibold">Todos os clientes</h2>
                                </header>
                                <div className="flex h-auto flex-wrap gap-[1%] overflow-x-hidden text-white">
                                    <div className="flex flex-col">
                                        <div className="-m-1.5 overflow-x-auto">
                                            <div className="inline-block min-w-full p-1.5 align-middle">
                                                <div className="overflow-hidden rounded-lg border border-gray-200">
                                                    <table className="w-full min-w-full divide-y divide-gray-200">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" className="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">ID</th>
                                                                <th scope="col" className="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Name</th>
                                                                <th scope="col" className="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Age</th>
                                                                <th scope="col" className="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Address</th>
                                                                <th scope="col" className="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody className="divide-y divide-gray-200">
                                                            { all_customers && all_customers.map((customer, index) => (
                                                                <tr>
                                                                    <td className="px-6 py-4 text-sm font-medium whitespace-nowrap text-gray-800">
                                                                        {customer.id}
                                                                    </td>
                                                                    <td className="px-6 py-4 text-sm font-medium whitespace-nowrap text-gray-800">
                                                                        {customer.name}
                                                                        <p>{customer.email}</p>
                                                                    </td>
                                                                    <td className="px-6 py-4 text-sm whitespace-nowrap text-gray-800">45</td>
                                                                    <td className="px-6 py-4 text-sm whitespace-nowrap text-gray-800">
                                                                        {customer.address}
                                                                        <p>{customer.city}</p>
                                                                    </td>
                                                                    <td className="px-6 py-4 text-end text-sm font-medium whitespace-nowrap">
                                                                        <button
                                                                            type="button"
                                                                            className="inline-flex items-center gap-x-2 rounded-lg border border-transparent text-sm font-semibold text-blue-600 hover:text-blue-800 focus:text-blue-800 focus:outline-hidden disabled:pointer-events-none disabled:opacity-50"
                                                                        >
                                                                            Delete
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            ))}

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        {/* Coluna da direita */}
                        <aside className="w-1/3 rounded bg-white p-4 shadow">
                            <h2 className="mb-2 text-lg font-semibold">Coluna Direita</h2>
                            <p>Conteúdo auxiliar ou estatísticas</p>
                        </aside>
                    </div>
                </main>
            </div>
        </>
    );
}
