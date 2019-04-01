from django import forms

class loginForm(forms.Form):
    user = forms.CharField(label='user', max_length=100)
    pwd = forms.CharField(label='pwd', max_length=100)

class registerForm(forms.Form):
	user = forms.CharField(label='user', max_length=100)
	pwd = forms.CharField(label='pwd', max_length=100)
	nm = forms.CharField(label='nm', max_length=100)
	ct = forms.CharField(label='ct', max_length=100)
	models = forms.CharField(label='models', max_length=100)
