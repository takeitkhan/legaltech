import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:user/controller/auth.dart';
import 'package:user/controller/user.dart';
import 'package:user/helper/api_client.dart';
import 'package:user/helper/local_storage.dart';
import 'package:user/helper/size_config.dart';
import 'package:user/view/screen/transaction.dart';

class LoginScreen extends StatefulWidget {
  const LoginScreen({Key? key}) : super(key: key);

  @override
  State<LoginScreen> createState() => _LoginScreenState();
}

class _LoginScreenState extends State<LoginScreen> {
  final TextEditingController numberController = TextEditingController();
  final TextEditingController passwordController = TextEditingController();
  bool obsecureText = true;
  final formKey = GlobalKey<FormState>();
  bool isChecked = false;

  @override
  Widget build(BuildContext context) {
    double height = SizeConfig.getHeight(context);
    double width = SizeConfig.getWidth(context);
    double fontSize(double size) {
      return size * width / 414;
    }

    return GestureDetector(
      onTap: () {
        FocusScope.of(context).unfocus();
      },
      child: GestureDetector(
        onTap: () {
          FocusScope.of(context).unfocus();
        },
        child: Scaffold(
          backgroundColor: Colors.white,
          body: Center(
            child: SingleChildScrollView(
              child: Padding(
                padding:
                    const EdgeInsets.symmetric(horizontal: 30, vertical: 20),
                child: Form(
                  key: formKey,
                  child: Stack(
                    children: [
                      Positioned(
                        top: 220,
                        right: 60,
                        child: Image.asset('asset/paint.png'),
                      ),
                      Column(
                        mainAxisSize: MainAxisSize.min,
                        crossAxisAlignment: CrossAxisAlignment.center,
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          Image.asset(
                            'asset/tax.png',
                            height: height / 4,
                          ),
                          Row(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: [
                              Text(
                                'Welcome to Tax Media',
                                style: TextStyle(
                                  fontSize: fontSize(24),
                                  fontWeight: FontWeight.bold,
                                  color: Colors.black,
                                ),
                              ),
                              Image.asset(
                                'asset/hello.png',
                                height: height / 15,
                                width: width / 15,
                              ),
                            ],
                          ),
                          Text(
                            'Please sign-in to your account and start the adventure',
                            textAlign: TextAlign.center,
                            style: TextStyle(
                              fontSize: fontSize(14),
                              color: const Color(0xFF6E6B7B),
                            ),
                          ),
                          SizedBox(height: height / 30),
                          CustomTextForm(
                            controller: numberController,
                            labelText: 'Phone',
                            hint: '01XXX NNNNNN',
                            keyboardType: TextInputType.number,
                            contentPadding:
                                const EdgeInsets.only(top: 5, left: 12),
                            validator: (value) {
                              if (value!.isEmpty) {
                                return 'Enter your number';
                              }
                              return null;
                            },
                          ),
                          SizedBox(height: height / 34),
                          CustomTextForm(
                            obsecureText: obsecureText,
                            controller: passwordController,
                            keyboardType: TextInputType.text,
                            labelText: 'Password',
                            hint: 'Password',
                            suffixIcon: IconButton(
                                splashRadius: 1.0,
                                onPressed: () {
                                  setState(() {
                                    obsecureText = !obsecureText;
                                  });
                                },
                                icon: obsecureText == false
                                    ? const Icon(
                                        Icons.visibility,
                                      )
                                    : const Icon(Icons.visibility_off)),
                            contentPadding:
                                const EdgeInsets.only(top: 10, left: 14),
                            validator: (value) {
                              if (value!.isEmpty) {
                                return 'Enter your password';
                              }
                              return null;
                            },
                          ),
                          Row(
                            mainAxisAlignment: MainAxisAlignment.spaceBetween,
                            children: [
                              Row(children: [
                                Checkbox(
                                  value: isChecked,
                                  checkColor: Colors.white,
                                  onChanged: (value) {
                                    setState(() {
                                      isChecked = value!;
                                    });
                                  },
                                  side: const BorderSide(
                                      color: Color(0xFFD8D6DE), width: 2),
                                  fillColor: MaterialStateProperty.all(
                                    const Color(0xFF6148FA),
                                  ),
                                ),
                                Text(
                                  'Remember me',
                                  style: TextStyle(
                                      fontSize: fontSize(14),
                                      color: Theme.of(context)
                                          .colorScheme
                                          .primary),
                                ),
                              ]),
                              Text(
                                'Forgot Password?',
                                style: TextStyle(
                                  color: Theme.of(context).colorScheme.primary,
                                ),
                              )
                            ],
                          ),
                          SizedBox(height: height / 10),
                          GetBuilder<AuthController>(builder: (controller) {
                            return controller.isLoading
                                ? CircularProgressIndicator(
                                    color:
                                        Theme.of(context).colorScheme.primary,
                                  )
                                : ElevatedButton(
                                    onPressed: () async {
                                      if (formKey.currentState!.validate()) {
                                        bool success =
                                            await Get.find<AuthController>()
                                                .login(
                                          numberController.text,
                                          passwordController.text,
                                        );

                                        final token = await Get.find<
                                                LocalStorageController>()
                                            .getToken();
                                        Get.find<ApiClient>().token = token;
                                        if (success) {
                                          Get.find<AuthController>()
                                              .currentUserInfo();
                                          await Get.find<UserController>()
                                              .getEntities();

                                          Get.to(() => const Transaction(),
                                              transition: Transition.fadeIn);
                                        } else {
                                          return;
                                        }
                                      }
                                    },
                                    style: ElevatedButton.styleFrom(
                                      minimumSize:
                                          const Size(double.infinity, 45),
                                      shape: RoundedRectangleBorder(
                                        borderRadius: BorderRadius.circular(10),
                                      ),
                                    ),
                                    child: const Text(
                                      'Login',
                                      style: TextStyle(
                                        color: Color(0xFFFFFFFF),
                                      ),
                                    ),
                                  );
                          }),
                          SizedBox(height: height / 35),
                          Wrap(
                            children: [
                              Text(
                                "Don't have any account?",
                                style: TextStyle(
                                    color:
                                        Theme.of(context).colorScheme.primary),
                              ),
                              Text(
                                'Register',
                                style: TextStyle(
                                    fontWeight: FontWeight.w700,
                                    color:
                                        Theme.of(context).colorScheme.primary),
                              )
                            ],
                          )
                        ],
                      ),
                    ],
                  ),
                ),
              ),
            ),
          ),
        ),
      ),
    );
  }
}

class CustomTextForm extends StatelessWidget {
  const CustomTextForm({
    Key? key,
    this.contentPadding,
    this.suffixText,
    this.suffixIcon,
    this.obsecureText,
    required this.labelText,
    required this.hint,
    required this.keyboardType,
    required this.validator,
    required this.controller,
  }) : super(key: key);
  final String labelText;
  final InkWell? suffixText;
  final TextInputType keyboardType;
  final TextEditingController controller;
  final String? Function(String?)? validator;
  final String hint;
  final EdgeInsetsGeometry? contentPadding;
  final Widget? suffixIcon;
  final bool? obsecureText;
  @override
  Widget build(BuildContext context) {
    return Wrap(
      runSpacing: 5.0,
      children: [
        Align(alignment: Alignment.topRight, child: suffixText),
        TextFormField(
          keyboardType: keyboardType,
          controller: controller,
          validator: validator,
          obscureText: obsecureText ?? false,
          decoration: InputDecoration(
            floatingLabelBehavior: FloatingLabelBehavior.always,
            labelText: labelText,
            labelStyle: TextStyle(
              fontWeight: FontWeight.w500,
              color: Theme.of(context).colorScheme.primary,
            ),
            suffixIcon: suffixIcon,
            contentPadding: contentPadding,
            border: OutlineInputBorder(
              borderRadius: BorderRadius.circular(10),
            ),
            enabledBorder: OutlineInputBorder(
              borderSide: const BorderSide(
                width: 2,
                color: Color(0xFFDADADA),
              ),
              borderRadius: BorderRadius.circular(10),
            ),
            focusedBorder: OutlineInputBorder(
              borderSide: BorderSide(
                width: 2,
                color: Theme.of(context).colorScheme.primary,
              ),
              borderRadius: BorderRadius.circular(10),
            ),
            hintText: hint,
            hintStyle: const TextStyle(
              color: Color(0xFFB9B9C3),
            ),
          ),
        ),
      ],
    );
  }
}
