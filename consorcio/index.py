import datetime
import tkinter as tk
from tkinter import messagebox

def definir_alarme():
    hora = input("Digite a hora do alarme (formato HH:MM): ")
    while True:
        agora = datetime.datetime.now().strftime("%H:%M")
        if agora == hora:
            messagebox.showinfo("Alarme", "Hora do alarme!")
            break

def main():
    definir_alarme()

if __name__ == "__main__":
    main()
