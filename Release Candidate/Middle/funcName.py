import ast

with open(r'/afs/cad.njit.edu/u/a/j/ajr74/public_html/answer.txt', 'r') as file:
    answer = file.read()

tree = ast.parse(answer)

for stmt in tree.body:
    if isinstance(stmt, ast.FunctionDef):
      print(stmt.name)
