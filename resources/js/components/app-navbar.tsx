// resources/js/Components/Navbar.jsx
import { Link, usePage } from '@inertiajs/react';
import { SharedData } from '@/types';
import { BellIcon, MailIcon } from 'lucide-react';

export default function AppNavbar() {
    const { auth } = usePage<SharedData>().props;

    return (
        <header className="bg-transparent">
            <div className="w-full mx-auto px-4 sm:px-6 lg:px-8">
                <div className="flex justify-between items-center h-16">
                    <div className="flex-shrink-0">
                        <Link href="/" className="text-xl font-bold text-gray-800">
                            MeuSite
                        </Link>
                    </div>

                    <nav className="hidden md:flex space-x-6 p-3">
                        <Link href="/home" className="text-gray-600 hover:text-gray-900 py-2 px-4 hover:bg-black hover:text-white rounded-3xl">Inicio</Link>
                        <Link href="/home" className="text-gray-600 hover:text-gray-900 py-2 px-4 hover:bg-black hover:text-white rounded-3xl">Estatísticas</Link>
                        <Link href="/customers" className="text-gray-600 hover:text-gray-900 py-2 px-4 hover:bg-black hover:text-white rounded-3xl">Clientes</Link>
                        <Link href="/campaigns" className="text-gray-600 hover:text-gray-900 py-2 px-4 hover:bg-black hover:text-white rounded-3xl">Campanhas</Link>
                    </nav>

                    <div className="hidden md:flex items-center space-x-4">
                        <button type="button" className="text-sm bg-[rgba(200,200,200,0.35)] text-black p-3 rounded-4xl">
                            <MailIcon size={16} />
                        </button>
                        <button type="button" className="text-sm bg-[rgba(200,200,200,0.35)] text-black p-3 rounded-4xl">
                            <BellIcon size={16} />
                        </button>
                        <Link href="/login" className="text-sm text-blue-600 hover:underline">
                            <img className="rounded-[50%] w-8 h-8" src="https://i.pravatar.cc/150?img=58" />
                        </Link>
                    </div>
                </div>
            </div>
        </header>
    )
}
