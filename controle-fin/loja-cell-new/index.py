import tkinter as tk
from tkinter import ttk

def add_transaction():
    description = description_entry.get()
    amount = float(amount_entry.get())
    type = type_combobox.get()
    payer_receiver = payer_receiver_entry.get()

    transaction = {
        'description': description,
        'amount': amount,
        'type': type,
        'payer_receiver': payer_receiver
    }

    # Verifica se a transação já existe na lista antes de adicioná-la
    transactionExists = any(t == transaction for t in transactions)
    if not transactionExists:
        transactions.append(transaction)
        update_transactions()

def reset_transactions():
    transactions.clear()
    update_transactions()

def update_transactions():
    table.delete(*table.get_children())
    for transaction in transactions:
        description = transaction['description']
        amount = transaction['amount']
        type = transaction['type']
        payer_receiver = transaction['payer_receiver']
        table.insert('', tk.END, values=(description, amount, type, payer_receiver))

    total_income = sum(t['amount'] for t in transactions if t['type'] == 'Receitas')
    total_expense = sum(t['amount'] for t in transactions if t['type'] == 'Despesas')
    balance = total_income - total_expense

    total_income_label.configure(text=f"Total de Receitas: R$ {total_income:.2f}")
    total_expense_label.configure(text=f"Total de Despesas: R$ {total_expense:.2f}")
    balance_label.configure(text=f"Saldo: R$ {balance:.2f}")

transactions = []

# Cria a janela principal
window = tk.Tk()
window.title("Sistema Financeiro")

# Cria os estilos
style = ttk.Style(window)
style.theme_use("clam")

style.configure("TLabel", foreground="#333", font=("Arial", 12))
style.configure("TEntry", font=("Arial", 12))
style.configure("TButton", font=("Arial", 12))
style.configure("TCombobox", font=("Arial", 12))

style.configure("Treeview",
                background="white",
                foreground="#333",
                fieldbackground="white",
                font=("Arial", 12))
style.configure("Treeview.Heading",
                background="#333",
                foreground="white",
                font=("Arial", 12, "bold"))

style.configure("Summary.TFrame", background="#f8f9fa")
style.configure("Total.TLabel", font=("Arial", 12, "bold"))

# Cria os widgets da interface
notebook = ttk.Notebook(window)
notebook.pack(fill="both", expand=True)

add_frame = ttk.Frame(notebook)
transactions_frame = ttk.Frame(notebook)
summary_frame = ttk.Frame(notebook, style="Summary.TFrame")

notebook.add(add_frame, text="Adicionar Transação")
notebook.add(transactions_frame, text="Transações")
notebook.add(summary_frame, text="Resumo Financeiro")

# Aba "Adicionar Transação"
description_label = ttk.Label(add_frame, text="Descrição:")
description_label.pack(pady=(20, 5))
description_entry = ttk.Entry(add_frame)
description_entry.pack(pady=5)

amount_label = ttk.Label(add_frame, text="Valor:")
amount_label.pack(pady=(10, 5))
amount_entry = ttk.Entry(add_frame)
amount_entry.pack(pady=5)

type_label = ttk.Label(add_frame, text="Tipo:")
type_label.pack(pady=(10, 5))
type_combobox = ttk.Combobox(add_frame, values=["Receitas", "Pagamento"])
type_combobox.pack(pady=5)

payer_receiver_label = ttk.Label(add_frame, text="Pagador/Recebedor:")
payer_receiver_label.pack(pady=(10, 5))
payer_receiver_entry = ttk.Entry(add_frame)
payer_receiver_entry.pack(pady=5)

add_button = ttk.Button(add_frame, text="Adicionar", command=add_transaction)
add_button.pack(pady=(20, 10))

# Aba "Transações"
table_frame = ttk.Frame(transactions_frame)
table_frame.pack(pady=(20, 0))

table = ttk.Treeview(table_frame, columns=("description", "amount", "type", "payer_receiver"), show="headings")
table.heading("description", text="Descrição")
table.heading("amount", text="Valor")
table.heading("type", text="Tipo")
table.heading("payer_receiver", text="Pagador/Recebedor")
table.pack(side="left", fill="y")

scrollbar = ttk.Scrollbar(table_frame, orient="vertical", command=table.yview)
scrollbar.pack(side="right", fill="y")
table.configure(yscrollcommand=scrollbar.set)

# Aba "Resumo Financeiro"
total_income_label = ttk.Label(summary_frame, style="Total.TLabel", text="Total de Receitas: R$ 0.00")
total_income_label.pack()

total_expense_label = ttk.Label(summary_frame, style="Total.TLabel", text="Total de Despesas: R$ 0.00")
total_expense_label.pack()

balance_label = ttk.Label(summary_frame, style="Total.TLabel", text="Saldo: R$ 0.00")
balance_label.pack()

reset_button = ttk.Button(summary_frame, text="Resetar", command=reset_transactions)
reset_button.pack(pady=10)

# Inicializa a interface
window.mainloop()
