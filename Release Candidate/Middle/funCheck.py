import ast

with open(r'/afs/cad.njit.edu/u/a/j/ajr74/public_html/funcName.txt', 'r') as file:
    funcName = file.read()

with open(r'/afs/cad.njit.edu/u/a/j/ajr74/public_html/answer.txt', 'r') as file:
    ans = file.read()

answer = ans.strip()

tree = ast.parse(answer)

for stmt in tree.body:
    if isinstance(stmt, ast.FunctionDef):
        if stmt.name != funcName:
            print("Incorrect function name")
        else:
            print("Correct function name")
